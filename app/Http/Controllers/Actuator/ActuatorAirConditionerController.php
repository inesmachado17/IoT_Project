<?php

namespace App\Http\Controllers\Actuator;

use App\Http\Controllers\AdminController;
use App\Models\AirConditioner;
use App\Models\AirConditionerValue;
use Illuminate\Http\Request;
use GuzzleHttp;


class ActuatorAirConditionerController extends AdminController
{
    public function index()
    {
        $airConditioners = (new AirConditioner())
            ->all()->toArray();

        $list = array_chunk($airConditioners, 3);

        return view('admin.actuators.air-conditioners.index', ['list' => $list]);
    }

    public function show($id)
    {
        $airConditioner = (new AirConditioner())->with('history')->find($id);

        if ($airConditioner == null) {
            return back()->withErrors([
                'error' => 'Air Conditioner id not found'
            ]);
        }

        return view('admin.actuators.air-conditioners.show', ['airConditioner' => $airConditioner]);
    }

    public function edit($id)
    {

        $airConditioner = (new AirConditioner())->find($id);

        if ($airConditioner != null) {
            return view('admin.actuators.air-conditioners.edit', ['airConditioner' => $airConditioner]);
        }

        return back()->withErrors([
            'error' => 'Air Conditioner not found'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->merge(['id' => $id]);
        $request->validate([
            'id'      => 'required|exists:blinds,id',
            'name'    => 'required|string',
            'setting' => 'required|numeric',
            'state'   => 'required|boolean'
        ]);

        $airConditioner = (new AirConditioner())->findOrFail($id);
        $airConditioner->name = $request['name'];
        $airConditioner->setting = $request['setting'];
        $airConditioner->state = $request['state'];

        $airConditionerValue = new AirConditionerValue();
        $airConditionerValue->state = $airConditioner->state;
        $airConditionerValue->setting = $airConditioner->setting;
        $airConditionerValue->air_conditioner_id = $airConditioner->id;
        $airConditionerValue->save();

        $airConditioner->save();

        return redirect('/actuators/air-conditioners');
    }
}
