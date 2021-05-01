<?php

namespace App\Http\Controllers\Actuator;

use App\Http\Controllers\Controller;
use App\Models\AirConditioner;
use Illuminate\Http\Request;
use GuzzleHttp;


class ActuatorAirConditionerController extends Controller
{
    public function index()
    {
        $airConditioners = (new AirConditioner())
            ->all()->toArray();

        $list = array_chunk($airConditioners, 3);

        return view('admin.actuators.air-conditioners.index', ['list' => $list]);
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

        if ($airConditioner->setting != $request['setting'] || $airConditioner->state != $request['state']) {
            $client = new GuzzleHttp\Client();

            try {
                $response = $client->post(env('APP_API_BASE_URL') . '/actuators/air-conditioners', [
                    'code'    => $id,
                    'setting' => $request['setting'],
                    'state'   => $request['state']
                ]); //['auth' =>  ['user', 'pass']]
            } catch (\Exception $exception) {
                dd($exception);
                return back()->withErrors([
                    'error' => 'Cisco Packet Tracer reponde with unknown error!'
                ]);
            }

            if ($response->getStatusCode() == 200 || $response->getStatusCode() == 204) {
                $airConditioner->setting = $request['setting'];
                $airConditioner->state = $request['state'];
            } else {
                return back()->withErrors([
                    'error' => 'Cisco Packet Tracer reponde with unknown error!'
                ]);
            }
        }

        $airConditioner->save();

        return redirect($request['return_to'] ?? '/actuators/air-conditioners');
    }
}
