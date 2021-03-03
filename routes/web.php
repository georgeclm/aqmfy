<?php

use App\Http\Controllers\ServicesController;
use App\Http\Controllers\UsersController;
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

Route::get('/', [ServicesController::class, 'index'])->name('services.index');
Route::group(['middleware' => 'auth', 'prefix' => 'service'], function () {
    Route::get('/create', [ServicesController::class, 'create'])->name('services.create');
    Route::post('/', [ServicesController::class, 'store'])->name('services.store;');
    Route::get('/{service}', [ServicesController::class, 'show'])->name('services.show');
    Route::get('/{service}/edit', [ServicesController::class, 'edit'])->name('services.edit');
    Route::patch('/{service}', [ServicesController::class, 'update'])->name('services.update');
    Route::delete('/{service}', [ServicesController::class, 'destroy'])->name('services.destroy');
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/{user}', [UsersController::class, 'show'])->name('profile.index');
});


Auth::routes();
