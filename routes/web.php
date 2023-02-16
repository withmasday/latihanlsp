<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');

Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('index');

Route::group(['prefix' => 'order'], function () {
    Route::get('/', [App\Http\Controllers\OrderController::class, 'index'])->name('order.orderindex');
    Route::get('show/{id}', [App\Http\Controllers\IndexController::class, 'order'])->name('order.show');
    Route::post('create/{id}', [App\Http\Controllers\OrderController::class, 'store'])->name('order.create');
    Route::get('whistlist/', [App\Http\Controllers\IndexController::class, 'allWhistlist'])->name('order.allwhistlist');
    Route::get('whistlist/{id}', [App\Http\Controllers\IndexController::class, 'whistlist'])->name('order.whistlist');
    Route::get('whistlist/del/{id}', [App\Http\Controllers\IndexController::class, 'removeWhistlist'])->name('order.removewhistlist');
});

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

        Route::group(['prefix' => 'product'], function () {
            Route::get('/', [App\Http\Controllers\ProductController::class, 'index'])->name('product.index');
            Route::get('/create', [App\Http\Controllers\ProductController::class, 'create'])->name('product.create');
            Route::post('/create', [App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
            Route::get('/detail/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('product.show');
            Route::get('/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
            Route::post('/update/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
            Route::get('/delete/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('product.destroy');
        });

        Route::group(['prefix' => 'order'], function () {
            Route::get('/', [App\Http\Controllers\AOrderController::class, 'index'])->name('order.index');
            Route::get('/confirm/{id}', [App\Http\Controllers\AOrderController::class, 'confirm'])->name('order.confirm');
            Route::get('/cancle/{id}', [App\Http\Controllers\AOrderController::class, 'cancle'])->name('order.cancle');
        });
    });
});