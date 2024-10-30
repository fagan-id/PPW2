<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\LoginRegisterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\TestController;
use App\Mail\SendEmail;
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

Route::get('/dashboard_admin', function () {
    return view('dashboard_admin');
});

Route::get('/posts',[PostController::class,'index']);

Route::get('/test',[TestController::class,'index']);

// iNDEX buKU
Route::get('/buku',[BukuController::class,'index'])->name('dashboard_admin');

// Create pada 'buku'
Route::get('/buku/create',[BukuController::class,'create']) ->name('buku.create');
Route::post('/buku',[BukuController::class,'store'])->name('buku.store');

// Delete
Route::delete('/buku/{id}',[BukuController::class,'destroy']) ->name('buku.destroy');

// Update
Route::get('/buku/show/{id}',[BukuController::class,'show'])->name('buku.show');
Route::post('/buku/{id}',[BukuController::class,'update'])->name('buku.update');

// Search
Route::get('/buku/search',[BukuController::class,'search'])->name('buku.search');

// Login - Register
Route::controller(LoginRegisterController::class)->group(function(){
    Route::get('/register','register')->name('register');
    Route::post('/store','store')->name('store');
    Route::get('/login','login')->name('login');
    Route::post('/authenticate','authenticate')->name('authenticate');
    Route::get('/dashboard','dashboard')->name('dashboard');
    Route::post('/logout','logout')->name('logout');
});

// Send Email
Route::get('/send-email',[SendEmailController::class,'index'])->name('kirim-email');
Route::post('/post-email',[SendEmailController::class,'store'])->name('post-email');
