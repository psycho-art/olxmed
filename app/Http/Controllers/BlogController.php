<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index() {
        $blog = Blog::latest()->paginate(6);

        $blogCategories = BlogCategory::orderBy('name')->get();

        $banners = Banner::where('page', 'blog')->first();

        return view('frontend.blog.index', compact('blog', 'blogCategories', 'banners'));
    }

    public function detail($slug) {
        $post = Blog::where('slug', $slug)->first();

        $postImages = \DB::table('blog_images')->where('post_id', $post->id)->get();

        $blogCategories = BlogCategory::orderBy('name')->get();

        return view('frontend.blog.detail', compact('post', 'postImages', 'blogCategories'));
    }

    public function search(Request $request) {
        $keywords = $request->keywords;

        $blog = Blog::where('title', 'LIKE', '%' . $keywords . '%')->orWhere('short_description', 'LIKE', '%' . $keywords . '%')->orWhere('content', 'LIKE', '%' . $keywords . '%')->paginate(6);

        $blogCategories = BlogCategory::orderBy('name')->get();

        return view('frontend.blog.search', compact('blog', 'blogCategories', 'keywords'));
    }
}
