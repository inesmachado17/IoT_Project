<?php

use App\Models\Humidity;
use App\Models\Light;
use App\Models\Motion;
use App\Models\Smoke;
use App\Models\Temperature;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

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
        "value" => "required|numeric|min:0|max:10000",
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

/*
* API developed for demo purpose
* Simulate cisco packet tracer Server
*/
/*
Route::post('/actuators/blinds', function (Request $request) {
    $errorDraw = random_int(0, 100);

    if ($errorDraw < 25) {
        return response('', 500);
    }

    return response('', 204); //No Content
});

Route::get('/sensors/temperatures', function (Request $request) {

    $last = (new Temperature())->orderBy('date', 'desc')->first();

    return response([
        'value' => $last->value + random_int(-2, 2),
        'date'  => Carbon::now()
    ], 200);
});

Route::get('/sensors/humidities', function (Request $request) {
    $last = (new Humidity())->orderBy('date','desc')->first();

    return response([
        'value' => $last->value + random_int(-2, 2)*10,
        'date'  => Carbon::now()
    ], 200);
});

Route::get('/sensors/lights', function (Request $request) {
    return response([
        'value' => random_int(0, 5000),
        'date'  => Carbon::now()
    ], 200);
});

Route::get('/sensors/smokes', function (Request $request) {
    $last = (new Smoke())->orderBy('date','desc')->first();
    $sinal = ['-', '+'];

    return response([
        'value' => $last->value + (int) ($sinal[random_int(0,1)] . rand(0, 100)),
        'date'  => Carbon::now()
    ], 200);
});

Route::get('/sensors/motions', function (Request $request) {
    $last = (new Motion())->orderBy('date','desc')->first();

    return response([
        'value' => $last->value,
        'date'  => Carbon::now()
    ], 200);
});
 */
