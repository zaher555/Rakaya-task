<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login',function(){
    return view('user.login');
});
Route::post('/login',[AuthController::class,'login'])->name('login')->middleware('guest');
Route::get('/logout',[AuthController::class,'logout'])->name('logout')->middleware('auth');
Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
Route::resource('books',BookController::class)->middleware('auth');
Route::get('/check',[BookController::class,'check'])->middleware(['auth','role:admin']);
Route::get('/generate-pdf', [BookController::class, 'generatePDF']);
