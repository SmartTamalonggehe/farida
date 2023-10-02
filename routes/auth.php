<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::middleware(['jwt_costume', 'ip_throttle'])->group(function () {
    Route::post('cek-token', [AuthController::class, 'cekToken']);
    Route::post('logout', [AuthController::class, 'logout']);
});
