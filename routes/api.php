<?php

use App\Models\AirConditioner;
use App\Models\FireAlarm;
use App\Models\Lamp;
use App\Models\Sensors\Humidity;
use App\Models\Sensors\Light;
use App\Models\Sensors\Motion;
use App\Models\Sensors\Smoke;
use App\Models\Sensors\Temperature;
use App\Models\Sprinkler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

// SENSORS
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


// ACTUATORS
Route::get('/actuators/{actuatorName}', function (Request $request, $actuatorName) {
    $actuators = [
        "air-conditionairs" => new AirConditioner(),
        "sprinklers"        => new Sprinkler(),
        "lamps"             => new Lamp(),
    ];

    if (!array_key_exists($actuatorName, $actuators)) {
        return response("Actuator name not recognized", 400);
    }

    $list = $actuators[$actuatorName]->orderBy('id', 'asc')->get();

    return response($list, 200);
});

Route::post('/actuators/fire-alarms', function (Request $request) {
    $validator = Validator::make($request->all(), [
        "value" => "required|boolean"
    ]);

    if ($validator->fails()) {
        return response($validator->messages(), 400);
    }

    try {
        $fireAlarm = new FireAlarm();
        $fireAlarm->value = $request['value'];

        $fireAlarm->save();
    } catch (\Exception $exception) {
        return response($exception->getMessage(), 500);
    }
    return response('', 204);
});

Route::post('/actuators/air-conditionairs', function (Request $request) {
    $validator = Validator::make($request->all(), [
        "id"    => "required|exists:air_conditioners,id",
        "state" => "required|boolean",
        "value" => 'required|numeric',
    ]);

    if ($validator->fails()) {
        return response($validator->messages(), 400);
    }

    try {
        $airConditionair = (new AirConditioner())->find($request["id"]);
        $airConditionair->state = $request['state'];
        $airConditionair->value = $request['value'];

        $airConditionair->save();
    } catch (\Exception $exception) {
        return response($exception->getMessage(), 500);
    }

    return response('', 204);
});

Route::post('/actuators/sprinklers', function (Request $request) {
    $validator = Validator::make($request->all(), [
        "id"    => "required|exists:sprinklers,id",
        "state" => "required|boolean"
    ]);

    if ($validator->fails()) {
        return response($validator->messages(), 400);
    }

    try {
        $sprinkler = (new Sprinkler())->find($request["id"]);
        $sprinkler->state = $request['state'];

        $sprinkler->save();
    } catch (\Exception $exception) {
        return response($exception->getMessage(), 500);
    }

    return response('', 204);
});

Route::post('/actuators/lamps', function (Request $request) {
    $validator = Validator::make($request->all(), [
        "id"    => "required|exists:lamps,id",
        "state" => "required|boolean",
        "value" => 'required|numeric',
    ]);

    if ($validator->fails()) {
        return response($validator->messages(), 400);
    }

    try {
        $lamp = (new Lamp())->find($request["id"]);
        $lamp->state = $request['state'];
        $lamp->value = $request['value'];

        $lamp->save();
    } catch (\Exception $exception) {
        return response($exception->getMessage(), 500);
    }

    return response('', 204);
});
