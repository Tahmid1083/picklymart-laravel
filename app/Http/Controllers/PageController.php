<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Order;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function contactUs()
    {
        return view('pages.contact');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:120'],
            'email'   => ['required', 'email', 'max:150'],
            'subject' => ['nullable', 'string', 'max:200'],
            'message' => ['required', 'string', 'min:10', 'max:3000'],
        ]);

        ContactMessage::create($validated);

        return back()->with('success', 'Thank you for reaching out! We will get back to you soon.');
    }

    public function wholesale()
    {
        return view('pages.wholesale');
    }

    public function policy(string $slug)
    {
        $policies = [
            'terms-conditions' => ['title' => 'Terms & Conditions'],
            'return-policy'    => ['title' => 'Return Policy'],
            'support-policy'   => ['title' => 'Support Policy'],
            'privacy-policy'   => ['title' => 'Privacy Policy'],
        ];

        abort_unless(isset($policies[$slug]), 404);

        return view('pages.policy', [
            'title'   => $policies[$slug]['title'],
            'slug'    => $slug,
        ]);
    }

    public function orders(Request $request)
    {
        $orders = Order::where('user_id', $request->user()->id)->with('items')->latest()->paginate(10);

        return view('users.orders', compact('orders'));
    }
}
