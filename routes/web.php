<?php

use App\Http\Controllers\Actuator\ActuatorAirConditionerController;
use App\Http\Controllers\Actuator\ActuatorBlindController;
use App\Http\Controllers\Actuator\ActuatorSprinklerController;
use App\Http\Controllers\Actuator\ActuatorDoorController;
use App\Http\Controllers\Actuator\ActuatorLampController;
use App\Http\Controllers\Actuator\ActuatorController;
use App\Http\Controllers\Actuator\ActuatorFireAlarmController;
use App\Http\Controllers\Sensor\SensorHumidityController;
use App\Http\Controllers\Sensor\SensorLightController;
use App\Http\Controllers\Sensor\SensorMotionController;
use App\Http\Controllers\Sensor\SensorSmokeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Sensor\SensorTemperatureController;
use App\Models\FireAlarm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $fireAlarm = null;
    if (Auth::check()) {
        $fireAlarm = (new FireAlarm())->latest()->first();
    }
    return view('home', ['isHome' => 'true', 'fireAlarm' => $fireAlarm]);
});


// Authenticated group router
Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/actuators', [ActuatorController::class, 'index']);

    Route::get('/actuators/blinds', [ActuatorBlindController::class, 'index']);
    Route::get('/actuators/blinds/{id}', [ActuatorBlindController::class, 'show']);
    Route::get('/actuators/blinds/{id}/edit', [ActuatorBlindController::class, 'edit'])->middleware('is.admin');
    Route::put('/actuators/blinds/{id}', [ActuatorBlindController::class, 'update'])->middleware('is.admin');

    Route::get('/actuators/air-conditioners', [ActuatorAirConditionerController::class, 'index']);
    Route::get('/actuators/air-conditioners/{id}', [ActuatorAirConditionerController::class, 'show']);
    Route::get('/actuators/air-conditioners/{id}/edit', [ActuatorAirConditionerController::class, 'edit'])->middleware('is.admin');
    Route::put('/actuators/air-conditioners/{id}', [ActuatorAirConditionerController::class, 'update'])->middleware('is.admin');

    Route::get('/actuators/sprinklers', [ActuatorSprinklerController::class, 'index']);
    Route::get('/actuators/sprinklers/{id}', [ActuatorSprinklerController::class, 'show']);
    Route::get('/actuators/sprinklers/{id}/edit', [ActuatorSprinklerController::class, 'edit'])->middleware('is.admin');
    Route::put('/actuators/sprinklers/{id}', [ActuatorSprinklerController::class, 'update'])->middleware('is.admin');

    Route::get('/actuators/doors', [ActuatorDoorController::class, 'index']);
    Route::get('/actuators/doors/{id}', [ActuatorDoorController::class, 'show']);
    Route::get('/actuators/doors/{id}/edit', [ActuatorDoorController::class, 'edit'])->middleware('is.admin');
    Route::put('/actuators/doors/{id}', [ActuatorDoorController::class, 'update'])->middleware('is.admin');

    Route::get('/actuators/lamps', [ActuatorLampController::class, 'index']);
    Route::get('/actuators/lamps/{id}', [ActuatorLampController::class, 'show']);
    Route::get('/actuators/lamps/{id}/edit', [ActuatorLampController::class, 'edit'])->middleware('is.admin');
    Route::put('/actuators/lamps/{id}', [ActuatorLampController::class, 'update'])->middleware('is.admin');

    Route::get('/actuators/fire-alarms/turn-off/{id}', [ActuatorFireAlarmController::class, 'turnOff'])->middleware('is.admin');

    Route::get('/sensors/temperatures', [SensorTemperatureController::class, 'index']);
    Route::get('/sensors/temperatures/force-update', [SensorTemperatureController::class, 'update']);

    Route::get('/sensors/humidities', [SensorHumidityController::class, 'index']);
    Route::get('/sensors/humidities/force-update', [SensorHumidityController::class, 'update']);

    Route::get('/sensors/smokes', [SensorSmokeController::class, 'index']);
    Route::get('/sensors/smokes/force-update', [SensorSmokeController::class, 'update']);

    Route::get('/sensors/lights', [SensorLightController::class, 'index']);
    Route::get('/sensors/lights/force-update', [SensorLightController::class, 'update']);

    Route::get('/sensors/motions', [SensorMotionController::class, 'index']);
    Route::get('/sensors/motions/force-update', [SensorMotionController::class, 'update']);
});

// Routes for authentication
require __DIR__ . '/auth.php';
