<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades;
use Illuminate\View\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();    

        Facades\View::composer('*', function (View $view) {
            $navCategories = Category::where('is_show_in_menu', true)->get();
            $view->with('navCategories', $navCategories);
        });

           Facades\View::composer('layouts.frontend.partials.category_nav', function (View $view) {
            $categoriesWithSub = Category::with('subCategories')->get();
            $view->with('categoriesWithSub', $categoriesWithSub);
        });
    }
}
