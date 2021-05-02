<?php

namespace App\Http\Controllers\Actuator;

use App\Http\Controllers\AdminController;
use App\Models\Lamp;
use App\Models\LampState;
use Illuminate\Http\Request;
use GuzzleHttp;

class ActuatorLampController extends AdminController
{
    public function index()
    {
        $pagination = (new Lamp())
            ->orderBy('name')
            ->paginate(10)
            ->toArray();

        return view('admin.actuators.lamps.index', [
            'lamps'    => $pagination['data'],
            'prev'     => $pagination['prev_page_url'],
            'next'     => $pagination['next_page_url'],
        ]);
    }

    public function show(Request $request, $id)
    {
        $returnUrl = $request->getSession()->previousUrl();

        $lamp = (new Lamp())->with('history')->find($id);

        if ($lamp == null) {
            return back()->withErrors([
                'error' => 'Lamp id not found'
            ]);
        }
        return view('admin.actuators.lamps.show', ['lamp' => $lamp, 'returnUrl' => $returnUrl]);
    }

    public function edit(Request $request, $id)
    {
        $returnUrl = $request->getSession()->previousUrl();

        $lamp = (new Lamp())->find($id);

        if ($lamp != null) {
            return view('admin.actuators.lamps.edit', ['lamp' => $lamp, 'returnUrl' => $returnUrl]);
        }

        return back()->withErrors([
            'error' => 'Lamp id not found'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->merge(['id' => $id]);
        $request->validate([
            'id'        => 'required|exists:lamps,id',
            'name'      => 'required|string',
            'setting'   => 'required|numeric|min:0|max:100',
            'state'     => 'required|boolean'
        ]);

        $lamp = (new Lamp())->findOrFail($id);
        $lamp->name = $request['name'];

        if ($lamp->state != $request['state'] || $lamp->setting != $request['setting']) {

            $client = new GuzzleHttp\Client();

            try {
                $response = $client->post(env('APP_API_BASE_URL') . '/actuators/lamps', [
                    'id'      => $id,
                    'state'   => $request['state'],
                    'setting' => $request['setting']
                ]); //['auth' =>  ['user', 'pass']]
            } catch (\Exception $exception) {
                return back()->withErrors([
                    'error' => 'Cisco Packet Tracer response with unknown error!'
                ]);
            }

            if ($response->getStatusCode() == 200 || $response->getStatusCode() == 204) {
                $lamp->state = $request['state'];
                $lamp->setting = $request['setting'];
            } else {
                return back()->withErrors([
                    'error' => 'Cisco Packet Tracer reponde with unknown error!'
                ]);
            }
        }

        $lampState = new LampState();
        $lampState->setting = $lamp->setting;
        $lampState->state = $lamp->state;
        $lampState->lamp_id = $lamp->id;
        $lampState->save();

        $lamp->save();

        return redirect($request['return_to'] ?? '/actuators/lamps');
    }
}
