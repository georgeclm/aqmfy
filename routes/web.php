<?php

use App\Http\Controllers\OrdersController;
use App\Http\Controllers\SellersController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WishlistsController;
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


Route::get('/', [ServicesController::class, 'index'])->name('services.index');
// for the search using ajax
Route::get("/search", [ServicesController::class, 'search']);
Route::middleware(['auth'])->group(function () {
    Route::prefix('service')->group(function () {
        Route::get('/create', [ServicesController::class, 'create'])->name('services.create');
        Route::post('/', [ServicesController::class, 'store'])->name('services.store');
        Route::get('/{service}', [ServicesController::class, 'show'])->name('services.show');
        Route::get('/{service}/edit', [ServicesController::class, 'edit'])->name('services.edit');
        Route::patch('/{service}', [ServicesController::class, 'update'])->name('services.update');
        Route::delete('/{service}', [ServicesController::class, 'destroy'])->name('services.destroy');
    });
    Route::get('/{user}', [UsersController::class, 'show'])->name('profile.index');


    Route::prefix('seller')->group(function () {
        Route::get("/create", [SellersController::class, 'create'])->name('sellers.create');
        Route::post('/', [SellersController::class, 'store'])->name('sellers.store');
        Route::get('/{seller}', [SellersController::class, 'show'])->name('sellers.show');
        Route::get('/{seller}/edit', [SellersController::class, 'edit'])->name('sellers.edit');
        Route::patch('/{service}', [SellersController::class, 'update'])->name('sellers.update');
    });
    Route::prefix('wishlists')->group(function () {
        Route::get('/{user}/wishlist', [WishlistsController::class, 'show'])->name('wishlists.show');
        Route::post('/', [WishlistsController::class, 'store'])->name('wishlists.store');
        Route::delete('/{wishlist}', [WishlistsController::class, 'destroy'])->name('wishlists.destroy');
    });
    Route::post('/wishlist/{service}', [WishlistsController::class, 'add'])->name('wishlists.add');

    Route::prefix('orders')->group(function () {
        Route::get('/{user}', [OrdersController::class, 'index'])->name('orders.index');
        Route::get('/{user}/order', [OrdersController::class, 'order'])->name('orders.show');
        Route::get('/{service}/ordernow', [OrdersController::class, 'orderNow'])->name('orders.nowShow');
        Route::post('/buy', [OrdersController::class, 'buyNow'])->name('orders.now');
        Route::post('/', [OrdersController::class, 'store'])->name('orders.store');
    });
});
