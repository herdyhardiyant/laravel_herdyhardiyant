<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\HospitalController;

Route::get('/', function () {
    return redirect('/hospitals');;
})->middleware('authcheck');

Route::get('/login', [UserController::class, 'showLogin']);
Route::post('/login', [UserController::class, 'login']);

Route::get('/register', [UserController::class, 'showRegister']);
Route::post('/register', [UserController::class, 'register']);

Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/logout', [UserController::class, 'logout']);

Route::middleware(['authcheck'])->group(function () {
    Route::resource('hospitals', HospitalController::class);
});

Route::middleware(['authcheck'])->group(function () {
    Route::resource('patients', PatientController::class);
});