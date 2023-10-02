<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CRUD\DosenController;
use App\Http\Controllers\CRUD\JadwalController;
use App\Http\Controllers\CRUD\MatkulController;
use App\Http\Controllers\CRUD\MhsController;
use App\Http\Controllers\CRUD\RuanganController;


Route::resource('ruangan', RuanganController::class);
Route::resource('matkul', MatkulController::class);
Route::resource('dosen', DosenController::class);
Route::resource('jadwal', JadwalController::class);
Route::resource('mhs', MhsController::class);
