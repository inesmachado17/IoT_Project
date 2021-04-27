<?php


namespace App\Http\Controllers\Sensor;

use App\Models\Humidity;
use Carbon\Carbon;
use GuzzleHttp;
use Illuminate\Database\Eloquent\Model;


class SensorHumidityController
{
    public function index()
    {
        $pagination = (new Humidity())
            ->latest('date')
            ->paginate(5)
            ->toArray();

        return view('admin.sensors.humidities.index', [
            'humidities'   => $pagination['data'],
            'prev'         => $pagination['prev_page_url'],
            'next'         => $pagination['next_page_url'],
        ]);
    }

    public function update()
    {
        $client = new GuzzleHttp\Client();
        try {
            $response = $client->get(env('APP_API_BASE_URL') . '/sensors/humidities');
        } catch (\Exception $exception) {
            return back()->withErrors([
            'error' => 'Cisco Packet Tracer reponde with unknown error!'
        ]);
        }

        if ($response->getStatusCode() == 200) {
            $responseData = json_decode($response->getBody()->getContents(), true);

            $humd = new Humidity();
            $humd->value = $responseData['value'];
            $humd->date = new Carbon($responseData['date']);
            $humd->save();
        } else {
            return back()->withErrors([
                'error' => 'Cisco Packet Tracer reponde with unknown error!'
            ]);
        }

        return redirect('/sensors/humidities');
    }
}
