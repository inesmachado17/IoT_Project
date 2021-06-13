<?php

namespace App\Http\Controllers\Actuator;

use App\Http\Controllers\AdminController;
use App\Models\FireAlarm;
use GuzzleHttp;
use Illuminate\Http\Request;

class ActuatorFireAlarmController extends AdminController
{
    public function disabled(Request $request, $id)
    {
        $fireAlarm = (new FireAlarm())->findOrFail($id);
        $fireAlarm->state = false;
        $fireAlarm->disabled = true;
        $fireAlarm->save();

        return redirect($request->getSession()->previousUrl());
    }

    public function enabled(Request $request, $id)
    {
        $fireAlarm = (new FireAlarm())->findOrFail($id);
        $fireAlarm->state = false;
        $fireAlarm->disabled = false;
        $fireAlarm->save();

        return redirect($request->getSession()->previousUrl());
    }
}
