<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index(Request $request, $name) {
        $category = Category::where('slug', $name)->first();

        $products = Product::where('category_id', $category->id)->paginate(10);


        return view('frontend.category', compact('products', 'category'));
        

    }
}
