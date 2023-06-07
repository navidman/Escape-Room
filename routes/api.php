<?php

use Illuminate\Support\Facades\Route;

Route::post('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');

Route::middleware('auth:api')->group(function () {

    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'revoke'])->name('revoke');

});
