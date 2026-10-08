<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Seller;
use App\Services\Cart;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        // Custom lightweight pagination markup (no Tailwind/Bootstrap needed)
        Paginator::defaultView('partials.pagination');
        Paginator::defaultSimpleView('partials.pagination');

        // Data shared with the store layout on every request
        View::composer(['layouts.app', 'partials.header', 'partials.footer', 'partials.category-sidebar'], function ($view) {
            $view->with([
                'sidebarCategories' => Category::sidebar()->with('children')->get(),
                'topSellersFooter'  => Seller::top()->take(5)->get(),
                'cartCount'         => Cart::count(),
                'cartTotal'         => Cart::total(),
            ]);
        });
    }
}
