<?php

use App\Http\Controllers\Actuator\ActuatorBlindController;
use App\Http\Controllers\Actuator\ActuatorController;
use App\Http\Controllers\Sensor\SensorSmokeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Sensor\SensorTemperatureController;
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

    Route::get('/sensors/temperatures', [SensorTemperatureController::class, 'index']);
    Route::get('/sensors/temperatures/force-update', [SensorTemperatureController::class, 'update']);

    Route::get('/sensors/alarmSmokes', [SensorSmokeController::class, 'index']);
});

// Routes for authentication
require __DIR__ . '/auth.php';
