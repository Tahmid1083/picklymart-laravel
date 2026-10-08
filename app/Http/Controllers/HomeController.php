<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Seller;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index', [
            'todaysDeals'    => Product::active()->with('category')->where('is_todays_deal', true)->latest()->take(4)->get(),
            'featured'       => Product::active()->with('category')->where('is_featured', true)->latest()->take(8)->get(),
            'bestSelling'    => Product::active()->with('category')->where('is_best_selling', true)->latest()->take(10)->get(),
            'newProducts'    => Product::active()->with('category')->where('is_new', true)->latest()->take(5)->get(),
            'showcaseCategories' => Category::showcase()
                ->whereIn('slug', ['robotics-kits-boards', 'robotics-accessories', 'electronic-components-sensors'])
                ->with(['products' => fn ($q) => $q->active()->latest()->take(4)])
                ->get(),
            'promoProducts'  => Product::active()->with('category')->where('is_featured', true)->oldest()->take(4)->get(),
            'sellers'        => Seller::top()->take(6)->get(),
        ]);
    }
}
