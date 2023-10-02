<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Http\Request;
use App\Http\Library\Slim;
use App\Models\Page;
use App\Rules\BannerImageRequired;
use Illuminate\Support\Facades\Validator;

class BannerController extends Controller
{
    protected static $counter;

    public function index() {
        $title = 'Banners | Admin Panel';

        $product = Banner::orderBy("id", 'desc')->get();

        return view('admin.banner.index', compact('title', 'product'));
    }

    public function create() {
        $title = "Add Banner | Admin Panel";

        $pages = Page::all();

        return view('admin.banner.create', compact('title', 'pages'));
    }

    public function store(Request $request) {
        $request->validate([
            'page' => 'required',
            'banner_image' => 'required',
            'status' => 'required',
        ]);

        if($request->slideshow == 'on') {
            $slideshow = "yes";
        } else {
            $slideshow = "no";
        }

        $bannerImage = $this->handleCropper('banner_image');

        Banner::create([
            'page' => $request->page,
            'image' => $bannerImage,
            'status' => $request->status,
            'slideshow' => $slideshow,
        ]);

        return redirect()->route('admin.banner.index')->with('msg', 'Banner created successfully');
    }

    public function edit(Banner $id) {
        $title = 'Edit Banners | Admin Panel';

        $banner = $id;

        $pages = Page::all();

        return view('admin.banner.edit', compact('title', 'banner', 'pages'));
    }

    public function update(Request $request, Banner $id) {
        $banner = $id;

        $validator = Validator::make($request->all(), [
            'page' => 'required',
            'text' => 'nullable|max:200',
            'status' => 'required',
        ]);
    
        $validator->after(function ($validator) use ($id, $request) {
            $dbCheck = Banner::where('id', $id->id)->first();
            $bannerImage = $request->input('banner_image');
    
            if (empty($dbCheck->image) && empty($bannerImage)) {
                $validator->errors()->add('banner_image', 'The Banner Image field is required.');
            }
        });
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $bannerImage = $this->handleCropper('banner_image');

        if($request->slideshow == 'on') {
            $slideshow = "yes";
        } else {
            $slideshow = "no";
        }

        if(!empty($bannerImage)) {
            $bannerUpdate = Banner::where('id', $banner->id)->update([
                'page' => $request->page,
                'image' => $bannerImage ,
                'status' => $request->status,
                'slideshow' => $slideshow,
            ]);
        } else {
            $bannerUpdate = Banner::where('id', $banner->id)->update([
                'page' => $request->page,
                'status' => $request->status,
                'slideshow' => $slideshow,
            ]);
        }

        if($bannerUpdate) {
            return redirect()->route('admin.banner.index')->with('msg', 'Banner updated successfully');
        } else {
            return back()->with('msg', 'Oops! Something went wrong');
        }
    }

    public function delete(Banner $id) {
        Slim::delete($id->image);
        $banner = $id->delete();

        if($banner) {
            return redirect()->route('admin.banner.index')->with('msg', 'Banner updated successfully');
        } else {
            return back()->with('msg', 'Oops! Something went wrong');
        }
    }

    public function deleteImage(Banner $id) {
        Slim::delete($id->image);

        $id->image = NULL;
        $id->save();

        return back()->with('msg', 'Image deleted successfully');
    }

    public function getPages()
    {
        return Laratables::recordsOf(Banner::class, BannerController::class);

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

    public static function laratablesCreatedAt($banner) 
    {
        return date('d M Y', strtotime($banner->created_at));
    }
    
    public static function laratablesUpdatedAt($banner) 
    {
        return date('d M Y', strtotime($banner->created_at));
    }

    public static function laratablesCustomAction($banner)
    {
            return view('admin.banner.buttons', compact('banner'))->render();
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

    public function checkBannerImage($attribute, $value, $parameters, $validator)
    {
        $id = $parameters[0];
        $dbCheck = Banner::where('id', $id)->first();

        if (empty($dbCheck->image) && empty($value)) {
            $validator->errors()->add($attribute, 'The Banner Image field is required.');
        }
    }

}
