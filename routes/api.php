<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\EscapeRoomController;
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

Route::post('login',[AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('bookings', [BookingController::class,'index']);
    Route::get('bookings/{id}', [BookingController::class,'show']);
    Route::post('bookings', [BookingController::class,'store']);
    Route::delete('bookings/{id}', [BookingController::class,'destroy']);
    Route::get('escape-rooms', [EscapeRoomController::class,'index']);
    Route::get('escape-rooms/{id}', [EscapeRoomController::class,'show']);
    Route::get('escape-rooms/time-slots/{id}', [EscapeRoomController::class,'time_slots']);
    Route::post('escape-rooms', [EscapeRoomController::class,'store']);
});

