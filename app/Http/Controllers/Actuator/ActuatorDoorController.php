<?php

namespace App\Http\Controllers\Actuator;

use App\Http\Controllers\Controller;
use App\Models\Door;
use App\Models\DoorState;
use Illuminate\Http\Request;
use GuzzleHttp;

class ActuatorDoorController extends Controller
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
            'locked'  => 'required|boolean'
        ]);

        $door = (new Door())->find($id);
        $door->name = $request['name'];
        $presence = false;

        if ($door->locked != $request['locked'] || $door->state != $request['state']) {
            $client = new GuzzleHttp\Client();

            try {
                $responseForPresence = $client->get(env('APP_API_BASE_URL') . '/sensors/motions');
                $presence = json_decode($responseForPresence->getBody()->getContents());

                $response = $client->post(env('APP_API_BASE_URL') . '/actuators/doors', [
                    'code'    => $id,
                    'state'   => $request['state'],
                    'locked'  => $request['locked']
                ]); //['auth' =>  ['user', 'pass']]
            } catch (\Exception $exception) {
                return back()->withErrors([
                    'error' => 'Cisco Packet Tracer response with unknown error!'
                ]);
            }

            if ($response->getStatusCode() == 200 || $response->getStatusCode() == 204) {
                $door->state = $request['state'];
                $door->locked = $request['locked'];
            } else {
                return back()->withErrors([
                    'error' => 'Cisco Packet Tracer response with unknown error!'
                ]);
            }
        }

        $doorState = new DoorState();
        $doorState->state = $door->state;
        $doorState->locked = $door->locked;
        $doorState->presence = boolval($presence);
        $doorState->door_id = $door->id;
        $doorState->save();

        $door->save();


        return redirect('/actuators/doors');
    }
}
