<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DosenAPI;
use App\Http\Controllers\API\JadwalAPI;
use App\Http\Controllers\API\ProdiAPI;
use App\Http\Controllers\API\MatkulAPI;
use App\Http\Controllers\API\RuanganAPI;

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

Route::prefix('prodi')->group(function () {
    Route::get('/', [ProdiAPI::class, 'index']);
    Route::get('/all', [ProdiAPI::class, 'all']);
});
Route::prefix('ruangan')->group(function () {
    Route::get('/', [RuanganAPI::class, 'index']);
    Route::get('/all', [RuanganAPI::class, 'all']);
});
Route::prefix('matkul')->group(function () {
    Route::get('/', [MatkulAPI::class, 'index']);
    Route::get('/all', [MatkulAPI::class, 'all']);
});
Route::prefix('dosen')->group(function () {
    Route::get('/', [DosenAPI::class, 'index']);
    Route::get('/all', [DosenAPI::class, 'all']);
});
Route::prefix('jadwal')->group(function () {
    Route::get('/', [JadwalAPI::class, 'index']);
    Route::get('/thn-smt', [JadwalAPI::class, 'byThnSmt']);
    Route::get('/by-dosen', [JadwalAPI::class, 'byDosen']);
    Route::get('/by-rps', [JadwalAPI::class, 'byRps']);
});
