<?php

namespace App\Http\Controllers\Actuator;

use App\Http\Controllers\AdminController;
use App\Models\FireAlarm;
use GuzzleHttp;
use Illuminate\Http\Request;

class ActuatorFireAlarmController extends AdminController
{
    public function turnOff(Request $request, $id)
    {
        $fireAlarm = (new FireAlarm())->findOrFail($id);

        $client = new GuzzleHttp\Client();

        try {
            $response = $client->post(env('APP_API_BASE_URL') . '/actuators/fire-alarms', [
                'code'  => $id,
                'state' => false
            ]); //['auth' =>  ['user', 'pass']]
        } catch (\Exception $exception) {
            return back()->withErrors([
                'error' => 'Cisco Packet Tracer response with unknown error!'
            ]);
        }

        if ($response->getStatusCode() == 200 || $response->getStatusCode() == 204) {
            $fireAlarm->state = false;
            $fireAlarm->save();

            return redirect($request->getSession()->previousUrl());
        }

        return back()->withErrors([
            'error' => 'Cisco Packet Tracer reponde with unknown error!'
        ]);
    }
}
