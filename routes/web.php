<?php

use App\Http\Controllers\PDF\BeritaAcaraController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('pdf')->group(function () {
    Route::get('berita-acara/{id}', [BeritaAcaraController::class, 'index'])->name('pdf.berita-acara');
});
