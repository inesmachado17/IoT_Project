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
