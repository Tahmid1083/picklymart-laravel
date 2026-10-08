<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'productCount'   => Product::count(),
            'orderCount'     => Order::count(),
            'customerCount'  => User::where('user_type', 'customer')->count(),
            'messageCount'   => ContactMessage::where('is_read', false)->count(),
            'recentOrders'   => Order::latest()->take(6)->get(),
            'revenue'        => Order::whereIn('status', ['processing', 'shipped', 'delivered'])->sum('total'),
        ]);
    }
}
