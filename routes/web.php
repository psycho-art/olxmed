<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('user.registerForm');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('user.loginForm');
Route::get('/admin', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin', [AdminLoginController::class, 'adminLogin'])->name('adminLogin');

Route::middleware('auth')->prefix('user')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('user.logout');

    //Products
    Route::get('product', [ProductController::class, 'index'])->name('user.product.index');
    Route::get('/product-datatable', [ProductController::class, 'getPages'])->name('user.product.datatable');
    Route::get('product/create', [ProductController::class, 'create'])->name('user.product.create');
    // Route::get('saveCities', [ProductController::class, 'saveCities'])->name('user.saveCities');
    Route::get('/product/getCities', [ProductController::class, 'getCities'])->name('user.product.getCities');
    Route::get('/product/getCategories', [ProductController::class, 'getCategory'])->name('user.product.getCategory');
    Route::post('/product/store', [ProductController::class, 'store'])->name('user.product.store');
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('user.product.edit');
    Route::get('/product/image/{id}/delete', [ProductController::class, 'deleteImage'])->name('user.product.deleteImage');
    Route::post('/product/{id}/update', [ProductController::class, 'update'])->name('user.product.update');
    Route::post('/product/{id}/delete', [ProductController::class, 'delete'])->name('user.product.delete');


    //Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('user.profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('user.profile.update');

});

//Categories 
Route::get('/cat/{name}', [CategoryController::class , 'index'])->name('category');
Route::get('/search', [HomeController::class, 'searchProduct'])->name('search');
Route::get('product/{slug}', [HomeController::class, 'productDetail'])->name('product-detail');

//Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('blog/search', [BlogController::class, 'search'])->name('blog.search');
Route::get('blog/{slug}', [BlogController::class, 'detail'])->name('blog.detail');

//Page
Route::get('/page/{slug}', [HomeController::class, 'pageDetail'])->name('page');
