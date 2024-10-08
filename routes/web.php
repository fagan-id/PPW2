<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TestController;
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

Route::get('/test', function () {
    return view('test');
});

Route::get('/posts',[PostController::class,'index']);

Route::get('/test',[TestController::class,'index']);

Route::get('/buku',[BukuController::class,'index']);

// Create pada 'buku'
Route::get('/buku/create',[BukuController::class,'create']) ->name('buku.create');
Route::post('/buku',[BukuController::class,'store'])->name('buku.store');

// Delete
Route::delete('/buku/{id}',[BukuController::class,'destroy']) ->name('buku.destroy');

// Update
Route::get('/buku/show/{id}',[BukuController::class,'show'])->name('buku.show');
Route::post('/buku/{id}',[BukuController::class,'update'])->name('buku.update');
