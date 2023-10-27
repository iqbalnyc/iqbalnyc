<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Admin Routes
Route::get('/dashboard', [AdminController::class, 'index']);
Route::get('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/login', [AdminController::class, 'adminlogin']);
Route::get('/admin/logout', [AdminController::class, 'adminLogout'])->middleware('admin');

Route::get('/admin/userregistration', [AdminController::class, 'userregister'])->middleware('admin');
Route::post('/admin/userregistration', [AdminController::class, 'registeration'])->middleware('admin');
Route::get('/admin/users', [AdminController::class, 'users'])->middleware('admin');
Route::post('/admin/userUpdate/{id}', [AdminController::class, 'userUpdate'])->middleware('admin');
Route::get('/admin/authorities', [AdminController::class, 'authorities'])->middleware('admin');
Route::post('/admin/authorities', [AdminController::class, 'authoritiesUpdate'])->middleware('admin');
Route::delete('admin/authorityDelete', [AdminController::class, 'authorityDelete'])->middleware('admin');


Route::get('/admin/products', [AdminController::class, 'products'])->middleware('admin');
Route::get('/admin/profile', [AdminController::class, 'profile'])->middleware('admin');
Route::post('/admin/profile', [AdminController::class, 'profileUpdate'])->middleware('admin');

Route::get('/admin/orders', [AdminController::class, 'orders'])->middleware('admin');
Route::get('/admin/productsEdit/{id}', [AdminController::class, 'productsEdit'])->middleware('admin');
Route::post('/admin/productsUpdate/{id}', [AdminController::class, 'productsUpdate'])->middleware('admin');
Route::delete('/admin/productDestroy/{post}', [AdminController::class, 'productDestroy'])->middleware('admin');

Route::get('/admin/orderDetail/{id}', [AdminController::class, 'orderDetail'])->middleware('admin');
Route::patch('/admin/orderUpdate/{id}', [AdminController::class, 'orderUpdate'])->middleware('admin');


// Customer/Product Routes
Route::get('/', [ProductController::class, 'index']);
Route::get('/product/detail/{id}', [ProductController::class, 'productDetail']);
Route::get('/product/order', [ProductController::class, 'productOrder']);
Route::get('/product/cart', [ProductController::class, 'cart']);
Route::get('/product/cartDelete', [ProductController::class, 'cartOrderDelete']);
Route::get('/product/checkout', [ProductController::class, 'checkout']);
Route::post('/product/processCheckout', [ProductController::class, 'processCheckout']);

Route::get('/customer/login', function () {
    if (session('userEmail')) {
        return redirect('/');
    }
    return view('customer.login', ['countCart' => null]);
});

// Customer Routes
Route::post('/customer/login', [CustomerController::class, 'login']);
Route::get('/customer/dashboard', [CustomerController::class, 'dashboard']);
Route::get('/customer/logout', [CustomerController::class, 'customerLogout']);
Route::get('/customer/profile', [CustomerController::class, 'profile']);
Route::post('/customer/profile', [CustomerController::class, 'profileUpdate']);

Route::get('/session', function () {
    if (session()->has('cart')) {
        $count = count(session('cart'));
        echo $count . "<br>";
        print_r(session()->all());
    } else {
        echo "session is NOT available.";
    }
});

Route::get('/sessionDestroy', [ProductController::class, 'sessionDestroy']);
