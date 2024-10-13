<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('user/list',[\App\Http\Controllers\UserController::class,'fetchUsers']); // Get users
Route::post('/coupon/create', [\App\Http\Controllers\CouponController::class, 'store']); // Create a coupon
Route::get('/coupon/list', [\App\Http\Controllers\CouponController::class, 'index']);  // Get coupons
Route::delete('/coupon/delete/{id}', [\App\Http\Controllers\CouponController::class, 'destroy']); // Delete a single coupon
Route::delete('/coupon/delete-all', [\App\Http\Controllers\CouponController::class, 'destroyAll']); // Delete all single coupon
