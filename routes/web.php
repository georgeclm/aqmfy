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


Route::get('/service/{service}', [ServicesController::class, 'show'])->name('services.show');
Route::get('/seller/{seller}', [SellersController::class, 'show'])->name('sellers.show');
Route::get('/categories/{category}', [CategoriesController::class, 'search'])->name('search.category');



Route::middleware(['auth'])->group(function () {
    Route::prefix('service')->group(function () {
        Route::get('/create', [ServicesController::class, 'create'])->name('services.create');
        Route::post('/', [ServicesController::class, 'store'])->name('services.store');
        Route::get('/{service}/edit', [ServicesController::class, 'edit'])->name('services.edit');
        Route::patch('/{service}', [ServicesController::class, 'update'])->name('services.update');
        Route::delete('/{service}', [ServicesController::class, 'destroy'])->name('services.destroy');
    });
    Route::get('/profile/{user}', [UsersController::class, 'edit'])->name('profiles.edit');
    Route::patch('/{user}', [UsersController::class, 'update'])->name('profiles.update');
    Route::post('/follow/{user}', [UsersController::class, 'follow']);



    Route::prefix('sellers')->group(function () {
        Route::get("/create", [SellersController::class, 'create'])->name('sellers.create');
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
        Route::post('/', [OrdersController::class, 'store'])->name('orders.store');
        Route::delete('/{order}', [OrdersController::class, 'destroy'])->name('orders.destroy');
    });
    Route::post('/rating', [RatingsController::class, 'store'])->name('ratings.store');
    Route::group(['prefix' => 'chat'], function () {
        // Chat Controller Data
        // the chat template view
        Route::get('/', [ChatController::class, 'index'])->name('chat');
        // for the room view
        Route::get('/rooms', [ChatController::class, 'rooms']);
        // to take all the messages inside a room
        Route::get('/room/{roomId}/messages', [ChatController::class, 'messages']);
        // to post the message to the database
        Route::post('/room/{roomId}/message', [ChatController::class, 'newMessage']);
        // to create a room link view
        Route::get('/create/room', [ChatController::class, 'create']);
        // to take each profile image
        Route::get('/{user}/profile', [ProfilesController::class, 'profileImage']);
        // for profile chat
        Route::get('/{user}/create/room', [ChatController::class, 'chat'])->name('chat.store');
    });
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
