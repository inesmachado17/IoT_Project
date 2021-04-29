<?php

namespace App\Http\Controllers\Sensor;

use App\Http\Controllers\Controller;
use App\Models\Temperature;
use Carbon\Carbon;
use Illuminate\Http\Request;
use GuzzleHttp;

class SensorTemperatureController extends Controller
{
    public function index()
    {
        $pagination = (new Temperature())
            ->latest('date')
            ->paginate(5)
            ->toArray();

        //gráfico de temperaturas das ultimas 24h
        $now = Carbon::now()->setTimezone('UTC');
        $later24h = $now->copy()->subHours(24);
        // fetch de temperaturas onde data esteja entre a hora de agora e a hora a 24 horas atrás
        $temps = (new Temperature())->whereBetween('date', [$later24h, $now])->get();

        //dd($temps->toArray());

        // agrupar as temperaturas por cada hora
        // calcular a media ou usar a primeira opcao?
        // qd nao houver medicao naquela hora o q fazer?


        $axisX = ['21:00', '22:00', '23:00', '00:00', '02:00', '03:00'];
        $axisY = [12, 13, 11, 9.3, -3, -1];

        return view('admin.sensors.temperatures.index',  [
            'temperatures' => $pagination['data'],
            'prev'         => $pagination['prev_page_url'],
            'next'         => $pagination['next_page_url'],
            'uriName'      => 'temperatures',
            'chart'        => [
                'x' => $axisX,
                'y' => $axisY
            ]
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
