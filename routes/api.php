<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\SitterController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\ListingController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('user', [AuthController::class, 'user']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('pets', PetController::class);
    Route::apiResource('listings', ListingController::class)->except(['index', 'show']);
    Route::apiResource('bookings', BookingController::class);
    Route::apiResource('reviews', ReviewController::class)->only(['index', 'store']);
    Route::apiResource('availability', AvailabilityController::class)->except(['show']);
});

Route::get('listings', [ListingController::class, 'index']);
Route::get('listings/{listing}', [ListingController::class, 'show']);
Route::get('sitters/nearby', [SitterController::class, 'nearby']); 