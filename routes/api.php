<?php

use Illuminate\Support\Facades\Route;

Route::post('login', [\App\Http\Controllers\Auth\AuthController::class, 'login'])->name('login');

Route::middleware('auth:api')->group(function () {

    Route::post('logout', [\App\Http\Controllers\Auth\AuthController::class, 'revoke'])->name('revoke');
    Route::get('escape-rooms', [\App\Http\Controllers\Room\RoomController::class, 'index'])->name('rooms.index');
    Route::get('escape-rooms/{id}', [\App\Http\Controllers\Room\RoomController::class, 'show'])->name('rooms.show');
    Route::get('escape-rooms/{id}/time-slots', [\App\Http\Controllers\Room\RoomController::class, 'getTimeSlots'])->name('rooms.time_slots');
    Route::post('bookings', [\App\Http\Controllers\Room\BookingController::class, 'store'])->name('bookings.store');
//    Route::get('bookings', [\App\Http\Controllers\Room\BookingController::class, 'index'])->name('bookings.index');
//    Route::delete('bookings/{id}', [\App\Http\Controllers\Room\BookingController::class, 'destroy'])->name('bookings.destroy');
});
