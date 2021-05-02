<?php

namespace App\Http\Controllers\Sensor;

use App\Http\Controllers\AdminController;
use App\Models\Sensors\Smoke;
use Carbon\Carbon;
use GuzzleHttp;

class SensorSmokeController extends AdminController
{
    public function index()
    {
        $pagination = (new Smoke())
            ->latest('date')
            ->paginate(5)
            ->toArray();

        $chart = (new Smoke())->getChartAxisXY();

        return view('admin.sensors.smokes.index',  [
            'smokes'  => $pagination['data'],
            'prev'    => $pagination['prev_page_url'],
            'next'    => $pagination['next_page_url'],
            'uriName' => 'smokes',
            'chart'   => $chart
        ]);
    }

    public function update()
    {
        $client = new GuzzleHttp\Client();

        try {
            $response = $client->get(env('APP_API_BASE_URL') . '/sensors/smokes'); //['auth' =>  ['user', 'pass']]
        } catch (\Exception $exception) {
            return back()->withErrors([
                'error' => 'Cisco Packet Tracer response with unknown error!'
            ]);
        }

        if ($response->getStatusCode() == 200) {
            $responseData = json_decode($response->getBody()->getContents(), true);

            $smoke = new Smoke();
            $smoke->value = $responseData['value'];
            $smoke->date = new Carbon($responseData['date']);
            $smoke->save();
        } else {
            return back()->withErrors([
                'error' => 'Cisco Packet Tracer response with unknown error!'
            ]);
        }

        return redirect('/sensors/smokes');
    }
}
