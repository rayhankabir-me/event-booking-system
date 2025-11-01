<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//user apis
Route::prefix('user')->name('user.')->group(function(){
    Route::post('/register', [AuthController::class,'register'])->name('register');
    Route::post('/login', [AuthController::class,'login'])->name('login');
});

Route::middleware('auth:sanctum')->prefix('user')->name('user.')->group(function(){
    Route::post('/logout', [AuthController::class,'logout'])->name('logout');
    Route::get('/me', [AuthController::class,'me'])->name('me');
});

// events routes
Route::middleware('auth:sanctum')->prefix('events')->group(function() {
    Route::get('/', [EventController::class,'index'])->withoutMiddleware('auth:sanctum');
    Route::get('/{event}', [EventController::class,'show'])->withoutMiddleware('auth:sanctum');
    Route::post('/', [EventController::class,'store'])->middleware('role:organizer');
    Route::match(['put', 'patch'], '/{event}', [EventController::class,'update'])->middleware('role:organizer');
    Route::delete('/{event}', [EventController::class,'destroy'])->middleware('role:organizer');

    // event tickets creation
    Route::post('/{event}/tickets', [TicketController::class,'store'])->middleware('role:organizer');
});

//tickets routes
Route::middleware('auth:sanctum')->prefix('tickets')->group(function() {
    Route::match(['put', 'patch'], '/{ticket}', [TicketController::class,'update'])->middleware('role:organizer');
    Route::delete('/{ticket}', [TicketController::class,'destroy'])->middleware('role:organizer');
});

//booking apis
Route::post('/tickets/{ticket}/bookings', [BookingController::class,'book'])->middleware(['auth:sanctum', 'role:customer']);
Route::middleware(('auth:sanctum'))->prefix('bookings')->group(function() {
    Route::get('/', [BookingController::class,'index']);
    Route::match(['put', 'patch'], '/{booking}/cancel', [BookingController::class,'cancel'])->middleware('role:customer');
});
