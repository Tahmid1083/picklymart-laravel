<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Store front routes (Picklymart)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth (URLs kept identical to picklymart.com)
Route::middleware('guest')->group(function () {
    Route::get('/users/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/users/login', [AuthController::class, 'login'])->name('login.attempt');
    Route::get('/users/registration', [AuthController::class, 'showRegistration'])->name('register');
    Route::post('/users/registration', [AuthController::class, 'register'])->name('register.store');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Catalog
Route::get('/categories', [CategoryController::class, 'allCategories'])->name('categories.all');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Cart & checkout
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.place');
Route::get('/checkout/success/{code}', [CheckoutController::class, 'success'])->name('checkout.success');

// Static pages
Route::get('/contact-us', [PageController::class, 'contactUs'])->name('contact');
Route::post('/contact-us', [PageController::class, 'submitContact'])->name('contact.submit');
Route::get('/wholesale', [PageController::class, 'wholesale'])->name('wholesale');
Route::get('/terms-conditions', [PageController::class, 'policy'])->defaults('slug', 'terms-conditions')->name('policy.terms');
Route::get('/return-policy', [PageController::class, 'policy'])->defaults('slug', 'return-policy')->name('policy.return');
Route::get('/support-policy', [PageController::class, 'policy'])->defaults('slug', 'support-policy')->name('policy.support');
Route::get('/privacy-policy', [PageController::class, 'policy'])->defaults('slug', 'privacy-policy')->name('policy.privacy');

// Customer area
Route::middleware('auth')->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/toggle', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::get('/orders', [PageController::class, 'orders'])->name('orders.index');
    Route::post('/product/{product}/review', [ProductController::class, 'storeReview'])->name('product.review');
});
