<?php

namespace App\Http\Controllers\Sensor;

use App\Models\Sensors\Light;
use Carbon\Carbon;
use GuzzleHttp;

class SensorLightController
{
    public function index()
    {
        $pagination = (new Light())
            ->latest('date')
            ->paginate(5)
            ->toArray();

        $chart = (new Light())->getChartAxisXY();

        return view('admin.sensors.lights.index', [
            'lights'   => $pagination['data'],
            'prev'     => $pagination['prev_page_url'],
            'next'     => $pagination['next_page_url'],
            'uriName'  => 'lights',
            'chart'    => $chart
        ]);
    }

    public function update()
    {
        $client = new GuzzleHttp\Client();
        try {
            $response = $client->get(env('APP_API_BASE_URL') . '/sensors/lights');
        } catch (\Exception $exception) {
            return back()->withErrors([
                'error' => 'Cisco Packet Tracer response with unknown error!'
            ]);
        }

        if ($response->getStatusCode() == 200) {
            $responseData = json_decode($response->getBody()->getContents(), true);

            $light = new Light();
            $light->value = $responseData['value'];
            $light->date = new Carbon($responseData['date']);
            $light->save();
        } else {
            return back()->withErrors([
                'error' => 'Cisco Packet Tracer response with unknown error!'
            ]);
        }

        return redirect('/sensors/lights');
    }
}
