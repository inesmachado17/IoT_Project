<?php

use App\Http\Controllers\Actuator\ActuatorBlindController;
use App\Http\Controllers\Actuator\ActuatorController;
use App\Http\Controllers\Sensor\SensorSmokeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});


// Authenticated group router
Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/actuators', [ActuatorController::class, 'index']);

    Route::get('/actuators/blinds', [ActuatorBlindController::class, 'index']);
    Route::get('/actuators/blinds/{id}/edit', [ActuatorBlindController::class, 'edit']);
    Route::put('/actuators/blinds/{id}', [ActuatorBlindController::class, 'update']);

    Route::get('/sensors/alarmSmoke', [SensorSmokeController::class, 'index']);
});

// Routes for authentication
require __DIR__ . '/auth.php';
