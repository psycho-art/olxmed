<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $featuredProducts = Product::where('featured', 'yes')->orderBy('created_at', 'desc')->take(6)->get();

        $products = Product::where('featured', 'no')->orderBy('created_at', 'desc')->take(6)->get();

        $bannersSlide = Banner::where('page', 'home')->where('slideshow', 'yes')->get();
        $banners = Banner::where('page', 'home')->where('slideshow', 'no')->take(2)->get();


        return view('frontend.index', compact('featuredProducts', 'products', 'banners', 'bannersSlide'));
    }

    public function searchProduct(Request $request) {
        $keywords = $request->keywords;
        $city_id = $request->city;

        $query = Product::
                    join('categories', 'products.category_id', '=', 'categories.id')
                    ->join('cities', 'products.city_id', '=', 'cities.id')
                    ->select('products.*');

        if($keywords) {
            $query->where(function($query) use ($keywords) {
                $query->where('products.title', 'like', '%'.$keywords.'%')
                ->orWhere('products.description', 'like', '%'.$keywords.'%')
                ->orWhere('cities.name', 'like', '%'.$keywords.'%');
            });
        }

        if($city_id) {
            $query->where('cities.id', $city_id);
        }

        $products = $query->paginate(10);

        return view('frontend.search', compact('products', 'keywords', 'city_id'));
    }

    public function productDetail(Request $request, $slug) {

        $slugArray = explode("_", $slug);

        $product = Product::where('id', $slugArray[1])->first();
        $category = Category::where('id', $product->category_id)->first();
        $image = \DB::table('product_images')->where('product_id', $product->id)->first();
        $prodImages = \DB::table('product_images')->where('product_id', $product->id)->get();

        $relatedProducts = Product::where('category_id', $category->id)->where('id', '!=', $product->id)->take(4)->get();

        return view('frontend.product-details', compact('product', 'category', 'prodImages', 'image', 'relatedProducts'));
    }

    public function pageDetail(Request $request, $slug) {
        $page = Page::where('slug', $slug)->first();
        $banner = Banner::where('page', $page->title)->first();

        return view('frontend.pages.page', compact('page', 'banner'));
    }
}
