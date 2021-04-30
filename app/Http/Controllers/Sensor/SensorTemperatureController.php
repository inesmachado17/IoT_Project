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
        $last24h = $now->copy()->subHours(24);
        // fetch de temperaturas onde data esteja entre a hora de agora e a hora a 24 horas atrás
        $temps = (new Temperature())->orderBy('date')->whereBetween('date', [$last24h, $now])->get();

        //dd($temps);

        // agrupar as temperaturas por cada hora
        // calcular a media ou usar a primeira opcao?
        // qd nao houver medicao naquela hora o q fazer?
        $lastHour = $now->setTimezone('Europe/Lisbon');

        $axisX = [];
        $axisY = [];

        for($i = 23; $i >= 0; $i--)
        {
            $hour = $lastHour->copy()->subHours($i);
            $axisX[]=$hour->format('H');
            $filter = $temps->filter(function ($item) use($hour) {
              return ((new Carbon($item->date))->setTimezone('Europe/Lisbon')->hour == $hour->hour);
            });

            if(count($filter)>0) {
                $axisY[]=$filter->first()->value;
            } else {
                $axisY[]=null;
            }
        }

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
