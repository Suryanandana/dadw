<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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
    return view('landing.index');
});

Route::get('/dashboard', function () {
    return view('landing.index');
})->middleware(['auth'])->name('dashboard');

// autentikasi
Route::post('/register', [App\Http\Controllers\Authentication::class, 'register']);
Route::post('/login', [App\Http\Controllers\Authentication::class, 'login']);
Route::get('/logout', [App\Http\Controllers\Authentication::class, 'logout']);
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill(); 
    return redirect('/');
})->name('verification.verify');