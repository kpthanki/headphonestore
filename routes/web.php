<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::resource('/contact', ContactController::class);
Route::get('/', function () {
    return view('frontend.home');
});
Route::get('/admin', function () {
    return view('auth.login');
});

Route::post('/addtocart', [App\Http\Controllers\CartController::class, 'addtocart']);
Route::post('/deletecartitem', [App\Http\Controllers\CartController::class, 'removecart']);
Route::post('/update-cart', [App\Http\Controllers\CartController::class, 'updatecart']);

Route::middleware(['auth'])->group(function(){
    Route::get('/mycart', [App\Http\Controllers\CartController::class, 'viewCart'])->name('frontend.cart');

    Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'checkout']);
    Route::post('/getaddress', [App\Http\Controllers\CheckoutController::class, 'add']);

    Route::get('/shipping', [App\Http\Controllers\CheckoutController::class, 'shipping']);
    Route::post('/getshipping', [App\Http\Controllers\CheckoutController::class, 'getshipping']);


    Route::get('/order', [App\Http\Controllers\CheckoutController::class, 'orderreview']);
    Route::get('/payment', [App\Http\Controllers\CheckoutController::class, 'payment']);

    Route::post('/placeorder', [App\Http\Controllers\CheckoutController::class, 'store_order']);
    Route::get('/viewproducts/{id}', [App\Http\Controllers\FrontController::class, 'viewproducts']);
    Route::get('/myorder',[App\Http\Controllers\FrontController::class, 'showOrderDetails']);
});
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/user', [App\Http\Controllers\FrontController::class, 'user'])->name('frontend.home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('auth.login');
Route::get('/sortProduct', [App\Http\Controllers\FrontController::class, 'sortProduct']);
Route::get('/products', [App\Http\Controllers\FrontController::class, 'list_grid'])->name('frontend.slider');
Route::get('/{url}', [App\Http\Controllers\FrontController::class, 'details'])->name('frontend.details');
