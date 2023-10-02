<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PreferenceController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\ServicesController;
use App\Models\BlogCategory;
use App\Models\Category;
use App\Models\Product;

Route::middleware('auth:admin')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    //blog
    Route::get('/blog', [BlogController::class, 'index'])->name('admin.blog.index');
    Route::get('/blog-datatable', [BlogController::class, 'getPages'])->name('admin.blog.datatable');
    Route::get('/blog/post/create', [BlogController::class, 'create'])->name('admin.blog.create');
    Route::post('/blog/post/store', [BlogController::class, 'store'])->name('admin.blog.store');
    Route::get('/blog/post/{id}/edit', [BlogController::class, 'edit'])->name('admin.blog.edit');
    Route::post('/blog/post/{id}/update', [BlogController::class, 'update'])->name('admin.blog.update');
    Route::get('/blog/post/image/{id}/delete', [BlogController::class, 'deleteImage'])->name('admin.blog.deleteImage');
    Route::post('/blog/post/{id}/delete', [BlogController::class, 'delete'])->name('admin.blog.delete');

    // blog categories
    Route::get('blog/category', [BlogCategoryController::class, 'index'])->name('admin.blog.category.index');
    Route::get('blog/category-datatable', [BlogCategoryController::class, 'getPages'])->name('admin.blog.category.datatable');
    Route::get('blog/category/create', [BlogCategoryController::class, 'create'])->name('admin.blog.category.create');
    Route::post('/blog/category/store', [BlogCategoryController::class, 'store'])->name('admin.blog.category.store');
    Route::get('/blog/category/{id}/edit', [BlogCategoryController::class, 'edit'])->name('admin.blog.category.edit');
    Route::post('/blog/category/{id}/update', [BlogCategoryController::class, 'update'])->name('admin.blog.category.update');
    Route::post('/blog/category/{id}/delete', [BlogCategoryController::class, 'delete'])->name('admin.blog.category.delete');

    //categories
    Route::get('product/category', [CategoryController::class, 'index'])->name('admin.product.category.index');
    Route::get('/category-datatable', [CategoryController::class, 'getPages'])->name('admin.category.datatable');
    Route::get('product/category/create', [CategoryController::class, 'create'])->name('admin.product.category.create');
    Route::post('/product/category/store', [CategoryController::class, 'store'])->name('admin.product.category.store');
    Route::get('/product/category/{id}/edit', [CategoryController::class, 'edit'])->name('admin.product.category.edit');
    Route::post('/product/category/{id}/update', [CategoryController::class, 'update'])->name('admin.product.category.update');
    Route::post('/product/category/{id}/delete', [CategoryController::class, 'delete'])->name('admin.product.category.delete');

    //Products
    Route::get('product', [ProductController::class, 'index'])->name('admin.product.index');
    Route::get('/product-datatable', [ProductController::class, 'getPages'])->name('admin.product.datatable');
    Route::get('product/create', [ProductController::class, 'create'])->name('admin.product.create');
    // Route::get('saveCities', [ProductController::class, 'saveCities'])->name('admin.saveCities');
    Route::get('/product/getCities', [ProductController::class, 'getCities'])->name('admin.product.getCities');
    Route::get('/product/getCategories', [ProductController::class, 'getCategory'])->name('admin.product.getCategory');
    Route::post('/product/store', [ProductController::class, 'store'])->name('admin.product.store');
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::get('/product/image/{id}/delete', [ProductController::class, 'deleteImage'])->name('admin.product.deleteImage');
    Route::post('/product/{id}/update', [ProductController::class, 'update'])->name('admin.product.update');
    Route::post('/product/{id}/delete', [ProductController::class, 'delete'])->name('admin.product.delete');

    //Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');

    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    //Banners
    Route::get('/banners', [BannerController::class, 'index'])->name('admin.banner.index');
    Route::get('banners/create', [BannerController::class, 'create'])->name('admin.banner.create');
    Route::get('/banners-datatable', [BannerController::class, 'getPages'])->name('admin.banner.datatable');
    Route::post('banners/store', [BannerController::class, 'store'])->name('admin.banner.store');
    Route::get('banners/{id}/edit', [BannerController::class, 'edit'])->name('admin.banner.edit');
    Route::post('banners/{id}/update', [BannerController::class, 'update'])->name('admin.banner.update');
    Route::post('banners/{id}/delete', [BannerController::class, 'delete'])->name('admin.banner.delete');
    Route::get('banners/{id}/deleteImage', [BannerController::class, 'deleteImage'])->name('admin.banner.deleteImage');

    //Pages
    Route::get('/page', [PageController::class, 'index'])->name('admin.pages');
    Route::get('/page/create', [PageController::class, 'add'])->name('admin.page.add');
    Route::get('/pages-datatable', [PageController::class, 'getPages'])->name('admin.pages.datatable');
    Route::post('page/add/store', [PageController::class, 'store'])->name('admin.page.store');
    Route::get('page/edit/{id}', [PageController::class, 'edit'])->name('admin.page.edit');
    Route::post('page/update/{id}', [PageController::class, 'update'])->name('admin.page.update');
    Route::post('page/delete/{id}', [PageController::class, 'delete'])->name('admin.page.delete');
    
    //Preferences
    Route::get('/preferences', [PreferenceController::class, 'index'])->name('admin.preferences');
    Route::post('/preferences', [PreferenceController::class, 'store'])->name('admin.preferences.store');

    //Seo
    Route::get('/seo/{name}', [SeoController::class, 'index'])->name('admin.seo');
    Route::post('/seo/{name}/update', [SeoController::class, 'update'])->name('admin.seo.store');

    //Services
    Route::get('service', [ServicesController::class, 'index'])->name('admin.service.index');
    Route::get('/service-datatable', [ServicesController::class, 'getPages'])->name('admin.service.datatable');
    Route::get('service/create', [ServicesController::class, 'create'])->name('admin.service.create');
});