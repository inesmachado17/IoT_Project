<?php

namespace App\Http\Controllers\Actuator;

use App\Http\Controllers\AdminController;
use App\Models\Sprinkler;
use App\Models\SprinklerValue;
use Illuminate\Http\Request;
use GuzzleHttp;

class ActuatorSprinklerController extends AdminController
{
    public function index()
    {
        $sprinklers = (new Sprinkler())
            ->all()->toArray();

        $list = array_chunk($sprinklers, 3);

        return view('admin.actuators.sprinklers.index', ['list' => $list]);
    }

    public function show($id)
    {
        $sprinkler = (new Sprinkler())->with('history')->find($id);

        if ($sprinkler == null) {
            return back()->withErrors([
                'error' => 'Sprinkler id not found'
            ]);
        }

        return view('admin.actuators.sprinklers.show', ['sprinkler' => $sprinkler]);
    }
    public function edit($id)
    {
        $sprinkler = (new Sprinkler())->find($id);

        if ($sprinkler != null) {
            return view('admin.actuators.sprinklers.edit', ['sprinkler' => $sprinkler]);
        }

        return back()->withErrors([
            'error' => 'Sprinkler id not found'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->merge(['id' => $id]);
        $request->validate([
            'id'      => 'required|exists:sprinklers,id',
            'name'    => 'required|string',
            'timer'   => 'required|numeric',
            'state'   => 'required|boolean'
        ]);

        $sprinkler = (new Sprinkler())->find($id);
        $sprinkler->name = $request['name'];

        if ($sprinkler->timer != $request['timer'] || $sprinkler->state != $request['state']) {
            $client = new GuzzleHttp\Client();

            try {
                $response = $client->post(env('APP_API_BASE_URL') . '/actuators/sprinklers', [
                    'id'      => $id,
                    'timer'   => $request['timer'],
                    'state'   => $request['state']
                ]); //['auth' =>  ['user', 'pass']]
            } catch (\Exception $exception) {
                return back()->withErrors([
                    'error' => 'Cisco Packet Tracer response with unknown error!'
                ]);
            }

            if ($response->getStatusCode() == 200 || $response->getStatusCode() == 204) {
                $sprinkler->timer = $request['timer'];
                $sprinkler->state = $request['state'];
            } else {
                return back()->withErrors([
                    'error' => 'Cisco Packet Tracer response with unknown error!'
                ]);
            }
        }

        $sprinklerValue = new sprinklerValue();
        $sprinklerValue->state = $sprinkler->state;
        $sprinklerValue->timer = $sprinkler->timer;
        $sprinklerValue->sprinkler_id = $sprinkler->id;
        $sprinklerValue->save();

        $sprinkler->save();


        return redirect('/actuators/sprinklers');
    }
}
