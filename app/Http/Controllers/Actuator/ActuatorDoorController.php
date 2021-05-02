<?php

namespace App\Http\Controllers\Actuator;

use App\Http\Controllers\Controller;
use App\Models\Door;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActuatorDoorController extends Controller
{
    public function index()
    {
        $doors = (new Door())
            ->all()->toArray();

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
            'auth'    => 'required|boolean'
        ]);

        $door = (new Door())->find($id);
        $door->name = $request['name'];

        if ($door->timer != $request['timer'] || $door->state != $request['state']) {
            $client = new GuzzleHttp\Client();

            try {
                $response = $client->post(env('APP_API_BASE_URL') . '/actuators/doors', [
                    'code'    => $id,
                    'state'   => $request['state'],
                    'auth'    => $request['auth']
                ]); //['auth' =>  ['user', 'pass']]
            } catch (\Exception $exception) {
                return back()->withErrors([
                    'error' => 'Cisco Packet Tracer response with unknown error!'
                ]);
            }

            if ($response->getStatusCode() == 200 || $response->getStatusCode() == 204) {
                $door->state = $request['state'];
                $door->auth = $request['auth'];
            } else {
                return back()->withErrors([
                    'error' => 'Cisco Packet Tracer response with unknown error!'
                ]);
            }
        }

        $doorState = new DoorState();
        $doorState->state = $door->state;
        $doorState->auth = $door->auth;
        $doorState->door_id = $door->id;
        $doorState->save();

        $door->save();


        return redirect('/actuators/doors');
    }
}
