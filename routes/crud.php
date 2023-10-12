<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CRUD\MhsController;
use App\Http\Controllers\CRUD\DosenController;
use App\Http\Controllers\CRUD\JadwalController;
use App\Http\Controllers\CRUD\MatkulController;
use App\Http\Controllers\CRUD\RuanganController;
use App\Http\Controllers\CRUD\UploadRPSController;
use App\Http\Controllers\CRUD\UploadAbsenController;
use App\Http\Controllers\CRUD\UploadNilaiController;
use App\Http\Controllers\CRUD\DetBeritaAcaraController;
use App\Http\Controllers\CRUD\UploadBeritaAcaraController;

Route::middleware(['jwt_costume', 'ip_throttle'])->group(function () {
    Route::resource('ruangan', RuanganController::class);
    Route::resource('matkul', MatkulController::class);
    Route::resource('dosen', DosenController::class);
    Route::resource('jadwal', JadwalController::class);
    Route::resource('mhs', MhsController::class);
    Route::prefix('upload')->group(function () {
        Route::resource('rps', UploadRPSController::class);
        Route::resource('absen', UploadAbsenController::class);
        Route::resource('berita-acara', UploadBeritaAcaraController::class);
        Route::resource('nilai', UploadNilaiController::class);
    });
    Route::resource('det-berita-acara', DetBeritaAcaraController::class);
});
