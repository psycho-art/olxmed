<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BlogCategoryController extends Controller
{
    protected static $counter;

    public function index() {
        $title = 'Blog Categories | Admin Panel';

        $category = BlogCategory::orderBy("id", 'desc')->get();

        return view('admin.blog.categories.index', compact('title', 'category'));
    }

    public function create() {
        $title = "Add Category | Admin Panel";

        return view('admin.blog.categories.add', compact('title'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:blog_categories',
        ], [
             'name.required' => "The Category Name field is required",
             'name.unique' => "This name has already been taken",
        ]);

        $slug = Str::slug($request->name);

        $category = BlogCategory::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        if($category) {
            return redirect()->route('admin.blog.category.index')->with('msg', 'Category created successfully');
        } else {
            return redirect()->route('admin.blog.category.index')->with('msg', 'Oops! Something went wrong');
        }
    }

    public function edit(BlogCategory $id) {
        $title = "Edit Category | Admin Panel";

        $data = $id;

        return view('admin.blog.categories.edit', compact('title', 'data'));
    }

    public function update(Request $request, BlogCategory $id) {
        $request->validate([
            'name' => ['required', Rule::unique('blog_categories')->ignore($id->id)],
        ], [
             'name.required' => "The Category Name field is required",
             'name.unique' => "This name has already been taken",
        ]);

        $slug = Str::slug($request->name);

        $category = BlogCategory::where('id', $id->id)->update([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        if($category) {
            return redirect()->route('admin.blog.category.index')->with('msg', 'Category updated successfully');
        } else {
            return redirect()->route('admin.blog.category.index')->with('msg', 'Oops! Something went wrong');
        }
    }

    public function delete(BlogCategory $id) {
        $cat =  $id->delete();
        
        if($cat) {
            return redirect()->route('admin.blog.category.index')->with('msg', 'Category deleted successfully');
        } else {
            return redirect()->route('admin.blog.category.index')->with('msg', 'Oops! Something went wrong');
        }

    }

    public function getPages()
    {
		return Laratables::recordsOf(BlogCategory::class, BlogCategoryController::class);
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

    public static function laratablesCreatedAt($category) 
    {
        return date('d M Y', strtotime($category->created_at));
    }
    
    public static function laratablesUpdatedAt($category) 
    {
        return date('d M Y', strtotime($category->created_at));
    }

    public static function laratablesCustomAction($category)
    {
            return view('admin.blog.categories.buttons', compact('category'))->render();
    }
}
