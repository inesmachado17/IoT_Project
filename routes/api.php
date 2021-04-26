<?php

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

/*
* API developed for demo purpose
* Emulate cisco packet tracer Server
*/
Route::post('/actuators/blinds', function (Request $request) {
    $errorDraw = random_int(0, 100);

    if ($errorDraw < 25) {
        return response('', 500);
    }

    return response('', 200);
});

Route::get('/sensors/temperatures', function (Request $request) {

    $last = (new Temperature())->orderBy('date', 'desc')->first();

    return response([
        'value' => $last->value + random_int(-2, 2),
        'date'  => Carbon::now()
    ], 200); //No Content
});
