<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopUserController;
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

require __DIR__.'/auth.php';

Route::get('/',[ShopController::class,'index'])->name('shop.index');
Route::get('/detail/{shop_id}',[ShopController::class,'detail']);
Route::get('/find',[ShopController::class,'search']);
Route::get('/thanks', [UserController::class, 'thanks']);
Route::group(['middleware' => 'auth'],function () {
    Route::get('/mypage',[UserController::class,'mypage']);
    Route::post('/favorite',[ShopController::class,'favorite']);
    Route::post('/favorite/delete', [ShopController::class, 'favoriteDelete']);
    Route::post('/reserve',[ReservationController::class,'reserve']);
    Route::post('/reserve/delete', [ReservationController::class, 'reserveDelete']);
    Route::post('/reserve/update',[ReservationController::class, 'reserveUpdate']);
    Route::post('/review',[ReviewController::class,'review']);
});

Route::group(['middleware' => 'auth:admin'],function () {
    Route::get('/admin',[AdminUserController::class,'index']);
    Route::post('/admin/shop-user/create',[AdminUserController::class,'shopUserCreate']);
});

Route::group(['middleware' => 'auth:shop-user'], function () {
    Route::get('/shop-user', [ShopUserController::class, 'index']);
});