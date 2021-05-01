<?php

namespace App\Http\Controllers\Sensor;

use App\Http\Controllers\Controller;
use App\Models\Sensors\Temperature;
use Carbon\Carbon;
use GuzzleHttp;

class SensorTemperatureController extends Controller
{
    public function index()
    {
        $pagination = (new Temperature())
            ->latest('date')
            ->paginate(5)
            ->toArray();

        $chart = (new Temperature())->getChartAxisXY();

        return view('admin.sensors.temperatures.index',  [
            'temperatures' => $pagination['data'],
            'prev'         => $pagination['prev_page_url'],
            'next'         => $pagination['next_page_url'],
            'uriName'      => 'temperatures',
            'chart'        => $chart
        ]);
    }

    public function update()
    {
        $client = new GuzzleHttp\Client();

        try {
            $response = $client->get(env('APP_API_BASE_URL') . '/sensors/temperatures'); //['auth' =>  ['user', 'pass']]
        } catch (\Exception $exception) {
            return back()->withErrors([
                'error' => 'Cisco Packet Tracer response with unknown error!'
            ]);
        }

        if ($response->getStatusCode() == 200) {
            $responseData = json_decode($response->getBody()->getContents(), true);

            $temp = new Temperature();
            $temp->value = $responseData['value'];
            $temp->date = new Carbon($responseData['date']);
            $temp->save();
        } else {
            return back()->withErrors([
                'error' => 'Cisco Packet Tracer response with unknown error!'
            ]);
        }

        return redirect('/sensors/temperatures');
    }
}
