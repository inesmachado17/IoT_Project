<?php

namespace App\Http\Controllers\Actuator;

use App\Http\Controllers\AdminController;
use App\Models\Door;
use App\Models\DoorState;
use Illuminate\Http\Request;
use GuzzleHttp;

class ActuatorDoorController extends AdminController
{
    public function index()
    {
        $doors = (new Door())
            ->with('history')
            ->get()->toArray();

        $list = array_chunk($doors, 3);

        return view('admin.actuators.doors.index', ['list' => $list]);
    }

    public function show($id)
    {
        $door = (new Door())->with('history')->find($id);

        if ($door == null) {
            return back()->withErrors([
                'error' => 'Door id not found'
            ]);
        }

        return view('admin.actuators.doors.show', ['door' => $door]);
    }
    public function edit($id)
    {
        $door = (new door())->find($id);

        if ($door != null) {
            return view('admin.actuators.doors.edit', ['door' => $door]);
        }

        return back()->withErrors([
            'error' => 'Door not found'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->merge(['id' => $id]);
        $request->validate([
            'id'      => 'required|exists:doors,id',
            'name'    => 'required|string',
            'state'   => 'required|boolean',
            'locked'  => 'required|boolean',
        ]);

        $door = (new Door())->find($id);
        $door->name = $request['name'];
        $door->state = $request['state'];
        $door->locked = $request['locked'];

        $doorState = new DoorState();
        $doorState->state = $door->state;
        $doorState->locked = $door->locked;
        $doorState->value = $door->value;
        $doorState->door_id = $door->id;
        $doorState->save();

        $door->save();


        return redirect('/actuators/doors');
    }
}
