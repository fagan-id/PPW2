<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\GalleryController;
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

// Search
Route::get('/buku/search',[BukuController::class,'search'])->name('buku.search');

// Admin Middleware
Route::controller(BukuController::class)->group(function(){
    Route::get('/buku','index')->name('dashboard_admin');
    Route::get('/buku/create','create')->name('buku.create');
    Route::post('/buku','store')->name('buku.store');
    Route::delete('/buku/{id}','destroy')->name('buku.destroy');
    Route::get('/buku/show/{id}','show')->name('buku.show');
    Route::post('/buku/{id}','update')->name('buku.update');
    Route::get('/buku/{id}','detail')->name('buku.detail');
});

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


// Gallery
Route::resource('gallery', GalleryController::class);
