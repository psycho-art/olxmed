<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Freshbitsweb\Laratables\Laratables;
use App\Http\Library\Slim;
use App\Models\BlogCategory;
use App\Models\Category;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    protected static $counter;

    public function index() {
        $title = 'Blog | Admin Panel';

        $blogs = Blog::orderBy("id", 'desc')->paginate(10);

        return view('admin.blog.index', compact('title', 'blogs'));
    }

    public function create() {
        $title = 'Add Post | Admin Panel';

        $categories = BlogCategory::orderBy('name')->get();

        return view('admin.blog.add', compact('title', 'categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'meta_keywords'     => 'required',
            'meta_description'  => 'required|max:200',
            'title'             => 'required',
            'short_description' => 'required|max:100',
            'content'           => 'required',
            'post_images'       => 'required|max:1000',
            'status'            => 'required',
            'category'          => 'required',
        ], [
            'post_images.max' => "The image size must not be greater than 1Mb",
        ]);

        $slug = Str::slug($request->title, '-');

        $blog = Blog::create([
            'meta_keywords'     => $request->meta_keywords,
            'meta_description'  => $request->meta_description,
            'title'             => $request->title,
            'short_description' => $request->short_description,
            'content'           => $request->content,
            'status'            => $request->status, 
            'slug'              => $slug,
            'category_id'       => $request->category,
        ]);

        $postImage = $this->handleCropper('post_images');

        if($postImage != false && !empty($blog)) {
            if(is_array($postImage)) {
                foreach ($postImage as $img) {
                    $name       = $img['output']['name'];
                    $base64Data = $img['output']['data'];
                    $output     = Slim::saveFile($base64Data, $name);

                    \DB::table('blog_images')->insert([
                        'post_id' => $blog->id,
                        'image' => $output['name'],
                    ]);
                }
            } else {
                \DB::table('blog_images')->insert([
                    'post_id' => $blog->id,
                    'image' => $postImage,
                ]);
            } 
        } else {
            return back()->with('msg', 'Oops! Something went wrong');
        } 

        return redirect()->route('admin.blog.index')->with('msg', 'Post created successfully');

    }

    public function edit(Blog $id) {
        $title = 'Edit Post | Blog | Admin Panel';

        $post = $id;
        $postImages = \DB::table('blog_images')->where('post_id', $post->id)->get();
        $categories = BlogCategory::orderBy('name')->get();

        return view('admin.blog.edit', compact('post', 'postImages', 'title', 'categories'));
    }

    public function update(Blog $id, Request $request) {
        $blog = $id;

        $postImage = $this->handleCropper('post_images');

        if($postImage == false) {
            $checkImgs = \DB::table('blog_images')->where('post_id', $blog->id)->first();
            if(empty($checkImgs)) {
                return back()->withInput()->withErrors(['post_images' => 'At least one image is required']);
            }
        }

        $request->validate([
            'meta_keywords'     => 'required',
            'meta_description'  => 'required|max:200',
            'title'             => 'required',
            'short_description' => 'required|max:100',
            'content'           => 'required',
            'status'            => 'required',
            'category'          => 'required',
        ]);

        $slug = Str::slug($request->title, '-');

        $blog = Blog::where('id', $id->id)->update([
            'meta_keywords'     => $request->meta_keywords,
            'meta_description'  => $request->meta_description,
            'title'             => $request->title,
            'short_description' => $request->short_description,
            'content'           => $request->content,
            'status'            => $request->status, 
            'slug'              => $slug,
            'category_id'       => $request->category,
        ]);


        if($postImage != false) {
            if(is_array($postImage)) {
                foreach ($postImage as $img) {
                    $name       = $img['output']['name'];
                    $base64Data = $img['output']['data'];
                    $output     = Slim::saveFile($base64Data, $name);

                    \DB::table('blog_images')->insert([
                        'post_id' => $id->id,
                        'image' => $output['name'],
                    ]);
                }
            } else {
                \DB::table('blog_images')->insert([
                    'post_id' => $id->id,
                    'image' => $postImage,
                ]);
            } 
        }

        return redirect()->route('admin.blog.index')->with('msg', 'Post updated successfully');

    }

    public function delete(Blog $id) {
        $blog_images = \DB::table('blog_images')->where('post_id', $id->id)->delete();
        $blog = $id->delete();

        if($blog && $blog_images) {
            return back()->with('msg', 'Post deleted successfully');
        } else {
            return back()->with('msg', 'Oops! Something went wrong');
        }
    }

    public function deleteImage($id) {
        $image = \DB::table('blog_images')->where('id', $id)->first();

        if($image) {
            Slim::delete($image->image);
            \DB::table('blog_images')->where('id', $id)->delete();
            return back();
        } else {
            return back()->with('msg', 'Oops! Something went wrong');
        }
    }

    public function getPages()
    {
		return Laratables::recordsOf(Blog::class, BlogController::class);
    }
    
	public static function laratablesQueryConditions($query)
	{
		self::$counter = app('request')->input('start');
		return $query->where('id', '>', 0);
    }

    public static function laratablesId($blog)
    {
        return ++self::$counter;
    }

    public static function laratablesCreatedAt($blog) 
    {
        return date('d M Y', strtotime($blog->created_at));
    }

    public static function laratablesCategoryId($blog) {
        $catName = BlogCategory::where('id', $blog->category_id)->first();
        return $catName->name;
    }
    
    public static function laratablesUpdatedAt($blog) 
    {
        return date('d M Y', strtotime($blog->created_at));
    }

    public static function laratablesCustomAction($blog)
    {
            return view('admin.blog.buttons', compact('blog'))->render();
    }

    private function handleCropper($name)
    {
        $cropperImg = Slim::getImages($name);

        if($cropperImg == false)
            return false;

        if (count($cropperImg) > 1) {
            return $cropperImg;
        } else {
            $singleImgData  = array_shift($cropperImg);
            $name           = $singleImgData['output']['name'];
            $base64Data     = $singleImgData['output']['data'];
            $output         = Slim::saveFile($base64Data, $name);

            return $output['name'];
        }
    }
}
