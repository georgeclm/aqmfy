<?php

use App\Http\Controllers\CategoriesController;
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
Route::get("/search", [ServicesController::class, 'search'])->name('search');
Route::get('/services/{service}', [ServicesController::class, 'show'])->name('services.show');
Route::get('/seller/{seller}', [SellersController::class, 'show'])->name('sellers.show');
Route::get('/search/{category}', [CategoriesController::class, 'search'])->name('search.category');



Route::middleware(['auth'])->group(function () {
    Route::prefix('services')->group(function () {
        Route::get('/c/create', [ServicesController::class, 'create'])->name('services.create');
        Route::post('/', [ServicesController::class, 'store'])->name('services.store');
        Route::get('/{service}/edit', [ServicesController::class, 'edit'])->name('services.edit');
        Route::patch('/{service}', [ServicesController::class, 'update'])->name('services.update');
        Route::delete('/{service}', [ServicesController::class, 'destroy'])->name('services.destroy');
    });
    Route::get('/profiles/{user}', [UsersController::class, 'show'])->name('profile.userprofile');


    Route::prefix('seller')->group(function () {
        Route::get("/s/create", [SellersController::class, 'create'])->name('sellers.create');
        Route::post('/', [SellersController::class, 'store'])->name('sellers.store');
        Route::get('/{seller}/edit', [SellersController::class, 'edit'])->name('sellers.edit');
        Route::patch('/{seller}', [SellersController::class, 'update'])->name('sellers.update');
    });
    Route::prefix('wishlists')->group(function () {
        Route::get('/{user}/wishlist', [WishlistsController::class, 'show'])->name('wishlists.show');
        Route::post('/{service}', [WishlistsController::class, 'add'])->name('wishlists.add');
    });

    Route::prefix('orders')->group(function () {
        Route::post('/{service}', [OrdersController::class, 'changeQuantity'])->name('orders.qty');
        Route::get('/{user}', [OrdersController::class, 'index'])->name('orders.index');
        Route::get('/{service}/order', [OrdersController::class, 'show'])->name('orders.show');
        Route::post('/{service}/pay', [OrdersController::class, 'pay'])->name('orders.pay');
        Route::post('/', [OrdersController::class, 'store'])->name('orders.store');
    });
});
