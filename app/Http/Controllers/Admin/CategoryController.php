<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Faker\Provider\ar_EG\Company;
use Illuminate\Http\Request;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Http\Library\Slim;
use App\Models\Product;

use function PHPUnit\Framework\isEmpty;

class CategoryController extends Controller
{
    protected static $counter;

    public function index() {
        $title = 'Product Categories | Admin Panel';

        $category = Category::orderBy("id", 'desc')->get();

        return view('admin.product.categories.index', compact('title', 'category'));
    }

    public function create() {
        $title = "Add Category | Admin Panel";

        $categories = Category::orderBy('name', 'desc')->get();

        return view('admin.product.categories.add', compact('title', 'categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'parent_id' => 'required',
            'name' => 'required|unique:categories',
            'icon' => 'required',
        ], [
            'parent_id.required' => "Please choose one option",
             'name.required' => "The Category Name field is required",
             'name.unique' => "This name has already been taken",
        ]);

        $slug = Str::slug($request->name);

        $category = Category::create([
            'parent_id' => $request->parent_id,
            'name' => $request->name,
            'slug' => $slug,
            'icon' => $request->icon,
        ]);

        if($category) {
            return redirect()->route('admin.product.category.index')->with('msg', 'Category created successfully');
        } else {
            return redirect()->route('admin.product.category.index')->with('msg', 'Oops! Something went wrong');
        }
    }

    public function edit(Category $id) {
        $title = "Edit Category | Admin Panel";

        $data = $id;
        $categories = Category::where('id', '!=', $data->id)->where('parent_id', '!=', $data->id)->orderBy('name', 'desc')->get();

        return view('admin.product.categories.edit', compact('title', 'data', 'categories'));
    }

    public function update(Request $request, Category $id) {
        $request->validate([
            'parent_id' => 'required',
            'name' => ['required', Rule::unique('categories')->ignore($id->id)],
            'icon' => 'required',
        ], [
            'parent_id.required' => "Please choose one option",
             'name.required' => "The Category Name field is required",
             'name.unique' => "This name has already been taken",
        ]);

        $slug = Str::slug($request->name);

        $category = Category::where('id', $id->id)->update([
            'parent_id' => $request->parent_id,
            'name' => $request->name,
            'slug' => $slug,
            'icon' => $request->icon,
        ]);

        if($category) {
            return redirect()->route('admin.product.category.index')->with('msg', 'Category updated successfully');
        } else {
            return redirect()->route('admin.product.category.index')->with('msg', 'Oops! Something went wrong');
        }
    }

    public function delete(Category $id) {
        $checkProducts = Product::where('category_id', $id->id)->get();
        
        if(!$checkProducts->isEmpty()) {
            return redirect()->route('admin.product.category.index')->with('error', 'Please delete the products associated with this category');
        }

        $child = Category::where('parent_id', $id->id)->delete();

        $cat =  $id->delete();
        
        if($cat) {
            return redirect()->route('admin.product.category.index')->with('msg', 'Category deleted successfully');
        } else {
            return redirect()->route('admin.product.category.index')->with('error', 'Oops! Something went wrong');
        }

    }

    public function getPages()
    {
		return Laratables::recordsOf(Category::class, CategoryController::class);
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

    public static function laratablesParentId($category) {
        $parentCategory = Category::where('id', $category->parent_id)->first();
        if($parentCategory) {
            return $parentCategory->name;
        } else {
            return "----";
        }
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
            return view('admin.product.categories.buttons', compact('category'))->render();
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
