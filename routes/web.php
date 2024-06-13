<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CandidateController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login-parpol'); 
})->name('login');

Route::get('/beranda-parpol', [CandidateController::class, 'index'])->name('beranda-parpol');

Route::get('/daftar-caleg-registrasi', [CandidateController::class, 'daftarCalegRegistrasi'])->name('daftar-caleg-registrasi')->middleware('auth');

Route::post('/proses-login', 'AuthController@login')->name('proses-login');

Route::get('/login-parpol', function () {
    return view('login-parpol');
})->name('login-parpol');

Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route untuk kandidat
Route::get('/candidates/create', [CandidateController::class, 'create'])->name('candidates.create')->middleware('auth');
Route::post('/candidates', [CandidateController::class, 'store'])->name('candidates.store')->middleware('auth');
