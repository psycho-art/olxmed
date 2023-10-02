<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Cities;
use App\Models\Product;
use Illuminate\Http\Request;
use Freshbitsweb\Laratables\Laratables;
use App\Http\Library\Slim;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    protected static $counter;

    public function index() {
        $title = 'Product | User Panel';

        $product = Product::orderBy("id", 'desc')->get();



        return view('user.product.index', compact('title', 'product'));
    }

    public function create() {
        $title = "Add Product | User Panel";

        $category = Category::where('parent_id', 0)->get();

        $html = "";
        foreach($category as $c) {
            $html .= "<p data-id=".$c->id." class='cat_p' style='padding: 0.8em; font-size: 1.2em; cursor: pointer;' >". ucfirst($c->name) ."</p>";
        }

        return view('user.product.add', compact('title', 'category', 'html'));
    }

    public function store(Request $request) {
        $request->validate([
            'category' => 'required',
            'title' => 'required',
            'description' => 'required',
            'product_images' => 'required|max:1000',
            'state' => 'required',
            'city' => 'required',
            'status' => 'required',
            'price' => 'required',
            'neighbourhood' => 'required|max:110',
            'number' => 'required|numeric'
        ], [
            'state.required' => "The Location field is required",
            'neighbourhood.required' => "Please enter your location",
            'neighbourhood.max' => "Maximun lenght cannot be greater then 110 characters"
        ]);

        $slug = Str::slug($request->title, '-');

        if($request->condition == 'U') {
            $condition = "used";
        } else {
            $condition = "new";
        }


        $product = Product::create([
            'title' => $request->title,
            'category_id' => $request->category,
            'description' => $request->description,
            'price' => $request->price,
            'slug' => $slug,
            'state' => $request->state,
            'city_id' => $request->city,
            'condition' => $condition,
            'user_id' => auth()->user()->id,
            'posted_by' => 'user',
            'status' => $request->status,
            'number' => $request->number,
            'neighbourhood' => $request->neighbourhood,
        ]);

        $productImage = $this->handleCropper('product_images');

        if($productImage != false && !empty($product)) {
            if(is_array($productImage)) {
                foreach ($productImage as $img) {
                    $name       = $img['output']['name'];
                    $base64Data = $img['output']['data'];
                    $output     = Slim::saveFile($base64Data, $name);

                    if(!is_array($output)) {
                        if($output == 'invalid extension') {
                            return back()->withInput()->withErrors(['product_images' => 'Invalid extension']);
                        }
                    }
                    
                    $thumbNameArray = explode(".", $output['name']);
                    $thumbName = array_shift($thumbNameArray);
                    $thumbName = $thumbName."_thumb.".end($thumbNameArray);

                    $image = Image::make(public_path('storage/'.$output['name']))->fit(110);
                    $image->save(public_path('productThumbs/'.$thumbName), 100);

                    \DB::table('product_images')->insert([
                        'product_id' => $product->id,
                        'image' => $output['name'],
                        'thumbnail' => $thumbName,
                    ]);
                }
            } else {
                if($productImage == 'invalid extension') {
                    return back()->withInput()->withErrors(['product_images' => 'Invalid extension']);
                } 
                $thumbNameArray = explode(".", $productImage);
                $thumbName = array_shift($thumbNameArray);
                $thumbName = $thumbName."_thumb.".end($thumbNameArray);
    
                $image = Image::make(public_path('storage/'.$productImage))->fit(110);
                $image->save(public_path('productThumbs/'.$thumbName), 100);
                \DB::table('product_images')->insert([
                    'product_id' => $product->id,
                    'image' => $productImage,
                    'thumbnail' => $thumbName,
                ]);
            } 
        } else {
            return back()->with('msg', 'Oops! Something went wrong');
        } 

        return redirect()->route('user.product.index')->with('msg', 'Product created successfully');

    }

    public function edit(Request $request, Product $id) {
        $title = "Edit Product | User Panel";

        $category = Category::where('parent_id', 0)->get();

        $html = "";
        foreach($category as $c) {
            $html .= "<p data-id=".$c->id." class='cat_p' style='padding: 0.8em; font-size: 1.2em; cursor: pointer;' >". ucfirst($c->name) ."</p>";
        }

        $product = $id;

        $productImages = \DB::table('product_images')->where('product_id', $product->id)->get();

        $productImages = $productImages->toArray();

        return view('user.product.edit', compact('title', 'category', 'html', 'product', 'productImages'));
    }

    public function update(Request $request, Product $id) {

        $productImage = $this->handleCropper('product_images');

        if($productImage == false) {
            $checkImgs = \DB::table('product_images')->where('product_id', $id->id)->first();
            if(empty($checkImgs)) {
                return back()->withInput()->withErrors(['product_images' => 'At least one image is required']);
            }
        }

        $request->validate([
            'category' => 'required',
            'title' => 'required',
            'description' => 'required',
            'state' => 'required',
            'city' => 'required',
            'status' => 'required',
            'price' => 'required',
            'neighbourhood' => 'required|max:110',
            'number' => 'required|numeric'
        ], [
            'state.required' => "The Location field is required",
            'neighbourhood.required' => "Please enter your location",
            'neighbourhood.max' => "Maximun lenght cannot be greater then 110 characters"
        ]);

        $slug = Str::slug($request->title, '-');

        if($request->condition == 'U') {
            $condition = "used";
        } else {
            $condition = "new";
        }

        $product = Product::where('id', $id->id)->update([
            'title' => $request->title,
            'category_id' => $request->category,
            'description' => $request->description,
            'price' => $request->price,
            'slug' => $slug,
            'state' => $request->state,
            'city_id' => $request->city,
            'condition' => $condition,
            'neighbourhood' => $request->neighbourhood,
            'number' => $request->number,
            'status' => $request->status,
        ]);

        if($productImage != false) {
            $getProductImages = \DB::table('product_images')->where('product_id', $id->id)->get();
            foreach($getProductImages as $getPi) {
                Slim::delete($getPi->image);
                unlink(public_path('productThumbs/'.$getPi->thumbnail));
                \DB::table('product_images')->where('product_id', $id->id)->delete();
            }
            if(is_array($productImage)) {
                foreach ($productImage as $img) {
                    $name       = $img['output']['name'];
                    $base64Data = $img['output']['data'];
                    $output     = Slim::saveFile($base64Data, $name);

                    if(!is_array($output)) {
                        if($output == 'invalid extension') {
                            return back()->withInput()->withErrors(['product_images' => 'Invalid extension']);
                        }
                    }
                    
                    $thumbNameArray = explode(".", $output['name']);
                    $thumbName = array_shift($thumbNameArray);
                    $thumbName = $thumbName."_thumb.".end($thumbNameArray);

                    $image = Image::make(public_path('storage/'.$output['name']))->fit(110);
                    $image->save(public_path('productThumbs/'.$thumbName), 100);

                    \DB::table('product_images')->insert([
                        'product_id' => $id->id,
                        'image' => $output['name'],
                        'thumbnail' => $thumbName,
                    ]);
                }
            } else {

                if($productImage == 'invalid extension') {
                    return back()->withInput()->withErrors(['product_images' => 'Invalid extension']);
                } 
                $thumbNameArray = explode(".", $productImage);
                $thumbName = array_shift($thumbNameArray);
                $thumbName = $thumbName."_thumb.".end($thumbNameArray);
    
                // dd(public_path('storage/'.$productImage));

                $image = Image::make(public_path('storage/'.$productImage))->fit(110);
                $image->save(public_path('productThumbs/'.$thumbName), 100);
                \DB::table('product_images')->insert([
                    'product_id' => $id->id,
                    'image' => $productImage,
                    'thumbnail' => $thumbName,
                ]);
            } 
        }

        return redirect()->route('user.product.index')->with('msg', 'Product updated successfully');

    }

    public function deleteImage($id) {
        $image = \DB::table('product_images')->where('id', $id)->first();

        if($image) {
            Slim::delete($image->image);
            unlink(public_path('productThumbs/'.$image->thumbnail));
            \DB::table('product_images')->where('id', $id)->delete();
            return back();
        } else {
            return back()->with('msg', 'Oops! Something went wrong');
        }
    }

    public function delete(Product $id) {
        $product_images = \DB::table('product_images')->where('product_id', $id->id)->get();
        foreach($product_images as $pI) {
            if($pI->image) {
                Slim::delete($pI->image);
                unlink(public_path('productThumbs/'.$pI->thumbnail));
                \DB::table('product_images')->where('id', $id)->delete();
            }
        }
        $product = $id->delete();

        if($product) {
            return back()->with('msg', 'Product deleted successfully');
        } else {
            return back()->with('msg', 'Oops! Something went wrong');
        }
    }

    // public function saveCities(Request $request) {
    //     $cities = $request->data1;
    //     foreach($cities as $c) {
    //         $stateName = $c['stateName'];
    //         if($stateName == 'Islamabad') {
    //             $stateName = 'Islamabad Capital Territory';
    //         }

    //         if($stateName == 'KPK') {
    //             $stateName = 'Khyber PakhtunKhwa';
    //         }

    //         foreach($c['cities'] as $cit) {
    //             \DB::table('cities')->insert([
    //                 'state' => $stateName,
    //                 'name' => $cit,
    //             ]);
    //         };
    //     }
    // }

    public function getCities(Request $request) {
        $state = $request->state;
        $cities = Cities::where('state', $state)->select('name', 'id')->get();

        $cities = $cities->toArray();
        // dd($cities);
        
        if($cities) {
            return response()->json(array(
                'cities' => $cities,
                'success' => true,
            ), 200);
        } else {
            return response()->json(array(
                'success' => false,
            ), 400);
        }
    }

    // public function getCategory(Request $request) {
    //     $cat_id = $request->id;
    //     $childCat = Category::where('parent_id', $cat_id)->get(); 

    //     if($childCat) {
    //         return response()->json(array(
    //             'cats' => $childCat,
    //             'success' => true,
    //         ), 200);
    //     } else {
    //         return response()->json(array(
    //             'success' => false,
    //         ), 400);
    //     }
    // }

    public function getCategory(Request $request) {
        $cat_id = $request->id;
        $childCat = Category::where('parent_id', $cat_id)->get(); 
        $allCats = Category::where('parent_id', 0)->get();

        $html = "";
        foreach($childCat as $c) {
            $html .= "<p data-id=".$c->id." class='cat_p' style='padding: 0.8em; font-size: 1.2em; cursor: pointer;' >". ucfirst($c->name) ."</p>";
        }

        if($html) {
            return response()->json(array(
                'html' => 'true',
                'data' => $html,
                'parent' => $html,
                'success' => true,
            ), 200);
        } else {

            foreach($allCats as $c) {
                $html .= "<p data-id=".$c->id." class='cat_p' style='padding: 0.8em; font-size: 1.2em; cursor: pointer;' >". ucfirst($c->name) ."</p>";
            }

            return response()->json(array(
                'html' => 'false',
                'parent' => $html,
                'success' => true,
            ), 200);
        }
    }

    public function getPages()
    {
        return Laratables::recordsOf(Product::class, ProductController::class);
        
    }
    
	public static function laratablesQueryConditions($query)
	{
		self::$counter = app('request')->input('start');
		return $query->where('id', '>', 0)->where('user_id', auth()->user()->id);
    }

    public static function laratablesId($blog)
    {
        return ++self::$counter;
    }

    public static function laratablesCategoryId($product) {
        $parentCategory = Category::where('id', $product->category_id)->first();
        if($parentCategory) {
            return $parentCategory->name;
        } else {
            return "----";
        }
    }

    public static function laratablesCreatedAt($product) 
    {
        return date('d M Y', strtotime($product->created_at));
    }
    
    public static function laratablesUpdatedAt($product) 
    {
        return date('d M Y', strtotime($product->created_at));
    }

    public static function laratablesCustomAction($product)
    {
            return view('user.product.buttons', compact('product'))->render();
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

            if(!is_array($output)) {
                if($output == 'invalid extension') {
                    return $output;
                }
            }

            return $output['name'];
        }
    }
}
