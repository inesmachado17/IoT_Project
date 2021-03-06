<?php

use App\Http\Controllers\ApiActuatorController;
use App\Models\Door;
use App\Models\FireAlarm;
use App\Models\Sensors\Humidity;
use App\Models\Sensors\Light;
use App\Models\Sensors\Motion;
use App\Models\Sensors\Smoke;
use App\Models\Sensors\Temperature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use function PHPUnit\Framework\isEmpty;

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

// SENSORS
Route::get('/sensors/all', function () {
    $list = [
        "temperatures"  => (new Temperature())->orderBy('date', 'desc')->first(),
        "humidities"    => (new Humidity())->orderBy('date', 'desc')->first(),
        "lights"        => (new Light())->orderBy('date', 'desc')->first(),
        "motions"       => (new Motion())->orderBy('date', 'desc')->first(),
        "smokes"        => (new Smoke())->orderBy('date', 'desc')->first(),
    ];

    return response($list);
});

Route::get('/sensors/{sensorName}', function (Request $request, $sensorName) {
    $sensors = [
        "temperatures"    => new Temperature(),
        "humidities"      => new Humidity(),
        "lights"          => new Light(),
        "motions"         => new Motion(),
        "smokes"          => new Smoke()
    ];

    if (!array_key_exists($sensorName, $sensors)) {
        return response("Sensor name not recognized", 400);
    }

    $find = $sensors[$sensorName]->orderBy('date', 'desc')->first();

    return response($find);
});

Route::post('/sensors/temperatures', function (Request $request) {

    $validator = Validator::make($request->all(), [
        'value' => 'required|numeric|min:-99.99|max:99.99',
        'date'  => 'required|date'
    ]);

    if ($validator->fails()) {
        return response($validator->messages(), 400);
    }

    try {
        $temp = new Temperature();
        $temp->value = $request['value'];
        $temp->date = new Carbon($request['date']);

        $temp->save();
    } catch (\Exception $exception) {
        return response('Internal server error!', 500);
    }

    return response('', 204); //No Content
});

Route::post('/sensors/humidities', function (Request $request) {
    $validator = Validator::make($request->all(), [
        "value" => "required|numeric|min:0|max:100",
        "date"  => "required|date"
    ]);

    if ($validator->fails()) {
        return response($validator->messages(), 400);
    }

    try {
        $humd = new Humidity();
        $humd->value = $request['value'];
        $humd->date = new Carbon($request['date']);

        $humd->save();
    } catch (\Exception $exception) {
        return response($exception->getMessage(), 500);
    }
    return response('', 204);
});

Route::post('/sensors/lights', function (Request $request) {
    $validator = Validator::make($request->all(), [
        "value" => "required|numeric|min:0|max:100",
        "date"  => "required|date"
    ]);

    if ($validator->fails()) {
        return response($validator->messages(), 400);
    }

    try {
        $light = new Light();
        $light->value = $request['value'];
        $light->date = new Carbon($request['date']);

        $light->save();
    } catch (\Exception $exception) {
        return response($exception->getMessage(), 500);
    }
    return response('', 204);
});

Route::post('/sensors/smokes', function (Request $request) {
    $validator = Validator::make($request->all(), [
        "value" => "required|numeric|min:0|max:500",
        "date"  => "required|date"
    ]);

    if ($validator->fails()) {
        return response($validator->messages(), 400);
    }

    try {
        $smoke = new Smoke();
        $smoke->value = $request['value'];
        $smoke->date = new Carbon($request['date']);

        $smoke->save();
    } catch (\Exception $exception) {
        return response($exception->getMessage(), 500);
    }
    return response('', 204);
});

Route::post('/sensors/motions', function (Request $request) {
    $validator = Validator::make($request->all(), [
        "value" => "required|boolean",
        "date"  => "required|date"
    ]);

    if ($validator->fails()) {
        return response($validator->messages(), 400);
    }

    try {
        $motion = new Motion();
        $motion->value = $request['value'];
        $motion->date = new Carbon($request['date']);

        $motion->save();
    } catch (\Exception $exception) {
        return response($exception->getMessage(), 500);
    }
    return response('', 204);
});


// FIRE ALARM
Route::get('/actuators/fire-alarms', function () {
    $item = (new FireAlarm())->latest()->first();

    return response($item, 200);
});
Route::post('/actuators/fire-alarms', function (Request $request) {
    $validator = Validator::make($request->all(), [
        "value" => "required|boolean",
        "disabled" => "boolean",
    ]);

    if ($validator->fails()) {
        return response($validator->messages(), 400);
    }

    $last = (new FireAlarm())->latest()->first();

    try {
        $fireAlarm = new FireAlarm();
        $fireAlarm->state = $request['value'];
        $fireAlarm->disabled = isset($request['disabled']) ? $request['disabled'] : $last->disabled;

        $fireAlarm->save();
    } catch (\Exception $exception) {
        return response($exception->getMessage(), 500);
    }
    return response('', 204);
});

// ACTUATORS
Route::post('/actuators/doors/toogle/{id}', function ($id) {

    $door = (new Door())->findOrFail($id);

    try {
        $door->state = $door->state == 0 ? 1 : 0;
        $door->save();
    } catch (\Exception $exception) {
        return response($exception->getMessage(), 500);
    }
    return response($door->state, 200);
});
Route::get('/actuators/{actuatorName}', [ApiActuatorController::class, 'index']);
//air-conditioners, sprinklers, lamps, smoke-alarms
Route::post('/actuators/{actuatorName}', [ApiActuatorController::class, 'update']);

//Webcam
Route::post('/webcam/oneshot/{webcamName}', function (Request $request, $webcamName) {
    $validator = Validator::make($request->all(), [
        "file" => "required|image|mimes:jpeg,png,jpg|max:2048"
    ]);

    if ($validator->fails()) {
        return response($validator->messages(), 400);
    }

    $request->file->storeAs(
        'webcam/images/oneshot',
        $webcamName . '.' . $request->file->extension(),
        'public'
    );

    return response('', 204);
});
