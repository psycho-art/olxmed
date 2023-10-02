<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Cities;
use App\Models\Seo;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $categories = Category::where('parent_id', '0')->orderBy('name')->get();
        $homeSeo = Seo::where('name', 'home')->first();
        $cities = Cities::orderBy('name')->get();

        View::share(['categories' => $categories, 'homeSeo' => $homeSeo, 'cities' => $cities]);
    }
}
