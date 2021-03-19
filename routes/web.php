<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\RatingsController;
use App\Http\Controllers\SellersController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WishlistsController;
use App\Http\Controllers\MessagesController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::get('autocomplete', [ServicesController::class, 'autocomplete'])->name('autocomplete');


Route::get('/categories/{category}', CategoriesController::class)->name('search.category');



Route::middleware('auth')->group(function () {
    // Route::resource('service', [ServicesController::class]);
    Route::prefix('services')->group(function () {
        Route::get('/create', [ServicesController::class, 'create'])->name('services.create');
        Route::get('/{service}', [ServicesController::class, 'show'])->name('services.show')->withoutMiddleware('auth');

        Route::post('/', [ServicesController::class, 'store'])->name('services.store');
        Route::get('/{service}/edit', [ServicesController::class, 'edit'])->name('services.edit');
        Route::patch('/{service}', [ServicesController::class, 'update'])->name('services.update');
        Route::delete('/{service}', [ServicesController::class, 'destroy'])->name('services.destroy');
        Route::get('/{service}/download', [ServicesController::class, 'getDownload'])->name('services.download');
    });
    Route::get('/profile/{user}', [UsersController::class, 'edit'])->name('profiles.edit')->middleware('verified');
    Route::patch('/{user}', [UsersController::class, 'update'])->name('profiles.update');
    Route::post('/follow/{user}', [UsersController::class, 'follow']);

    Route::prefix('sellers')->group(function () {
        Route::get("/create", [SellersController::class, 'create'])->name('sellers.create');

        Route::get('/{seller}', [SellersController::class, 'show'])->name('sellers.show')->withoutMiddleware('auth');
        Route::post('/', [SellersController::class, 'store'])->name('sellers.store');
        Route::get('/{seller}/edit', [SellersController::class, 'edit'])->name('sellers.edit');
        Route::patch('/{seller}', [SellersController::class, 'update'])->name('sellers.update');
    });
    Route::prefix('wishlists')->group(function () {
        Route::get('/', [WishlistsController::class, 'show'])->name('wishlists.show');
        Route::post('/{service}', [WishlistsController::class, 'add'])->name('wishlists.add');
    });

    Route::prefix('orders')->group(function () {
        Route::post('/{service}', [OrdersController::class, 'changeQuantity'])->name('orders.qty');
        Route::get('/{user}', [OrdersController::class, 'index'])->name('orders.index');
        Route::get('/{service}/order', [OrdersController::class, 'show'])->name('orders.show');
        Route::post('/{service}/pay', [OrdersController::class, 'pay'])->name('orders.pay');
        Route::post('/', [OrdersController::class, 'store'])->name('orders.store')->middleware(['password.confirm']);
        Route::delete('/{order}', [OrdersController::class, 'destroy'])->name('orders.destroy');
    });
    Route::post('/rating', [RatingsController::class, 'store'])->name('ratings.store');
    Route::group(['prefix' => 'messages'], function () {
        Route::get('/', [MessagesController::class, 'index'])->name('messages');
        Route::get('create', [MessagesController::class, 'create'])->name('messages.create');
        Route::post('/', [MessagesController::class, 'store'])->name('messages.store');
        Route::get('{id}', [MessagesController::class, 'show'])->name('messages.show');
        Route::put('{id}', [MessagesController::class, 'update'])->name('messages.update');
    });
    // to post the new room to the database
    Route::post('/create/room', [ChatController::class, 'store'])->name('room.store');
});
// Verify Email
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
