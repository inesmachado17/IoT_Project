<?php

namespace App\Http\Controllers\Actuator;

use App\Http\Controllers\AdminController;
use App\Models\SmokeAlarm;
use App\Models\SmokeAlarmValue;
use Illuminate\Http\Request;

class ActuatorSmokeAlarmController extends AdminController
{
    public function index()
    {
        $smokeAlarms = (new SmokeAlarm())
            ->all()->toArray();

        $list = array_chunk($smokeAlarms, 3);

        return view('admin.actuators.smoke-alarms.index', ['list' => $list]);
    }

    public function show($id)
    {
        $smokeAlarm = (new SmokeAlarm())->with('history')->find($id);

        if ($smokeAlarm == null) {
            return back()->withErrors([
                'error' => 'SmokeAlarm id not found'
            ]);
        }

        return view('admin.actuators.smoke-alarms.show', ['smokeAlarm' => $smokeAlarm]);
    }
    public function edit($id)
    {
        $smokeAlarm = (new SmokeAlarm())->find($id);

        if ($smokeAlarm != null) {
            return view('admin.actuators.smoke-alarms.edit', ['smokeAlarm' => $smokeAlarm]);
        }

        return back()->withErrors([
            'error' => 'SmokeAlarm id not found'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->merge(['id' => $id]);
        $request->validate([
            'id'        => 'required|exists:smoke_alarms,id',
            'name'      => 'required|string',
            'setting'   => 'required|numeric',
            'state'     => 'required|boolean',
            'automatic' => 'required|boolean'
        ]);

        $smokeAlarm = (new SmokeAlarm())->find($id);
        $smokeAlarm->name = $request['name'];
        $smokeAlarm->setting = $request['setting'];
        $smokeAlarm->state = $request['state'];
        $smokeAlarm->automatic = $request['automatic'];

        $smokeAlarmValue = new SmokeAlarmValue();
        $smokeAlarmValue->state = $smokeAlarm->state;
        $smokeAlarmValue->setting = $smokeAlarm->setting;
        $smokeAlarmValue->smoke_alarm_id = $smokeAlarm->id;
        $smokeAlarmValue->save();

        $smokeAlarm->save();

        return redirect('/actuators/smoke-alarms');
    }
}
