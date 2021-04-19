<?php

use App\Http\Controllers\Actuator\ActuatorBlindController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [AuthController::class, 'login']);


// Authenticated group router
Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout', [AuthController::class, 'login']);

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/actuators/blinds', [ActuatorBlindController::class, 'index']);
});
