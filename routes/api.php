<?php

use App\Models\Humidity;
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

    if($validator->fails()) {
        return response($validator->messages(), 400);
    }

    try {
        $humd = new Humidity();
        $humd->value = $request['value'];
        $humd->date = new Carbon($request['date']);

        $humd->save();
    } catch(\Exception $exception) {
        return response($exception->getMessage(), 500);
    }
    return response('', 204);
});

/*
* API developed for demo purpose
* Simulate cisco packet tracer Server
*/

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
