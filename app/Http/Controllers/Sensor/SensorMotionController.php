<?php


namespace App\Http\Controllers\Sensor;

use App\Http\Controllers\Controller;
use App\Models\Motion;
use Carbon\Carbon;
use GuzzleHttp;

class SensorMotionController extends Controller
{
    public function index()
    {
        $pagination = (new Motion())
            ->latest('date')
            ->paginate(5)
            ->toArray();

        return view('admin.sensors.motions.index',  [
            'motions' => $pagination['data'],
            'prev'    => $pagination['prev_page_url'],
            'next'    => $pagination['next_page_url'],
            'uriName' => 'motions'
        ]);
    }

    public function update()
    {
        $client = new GuzzleHttp\Client();

        try {
            $response = $client->get(env('APP_API_BASE_URL') . '/sensors/motions'); //['auth' =>  ['user', 'pass']]
        } catch (\Exception $exception) {
            return back()->withErrors([
                'error' => 'Cisco Packet Tracer response with unknown error!'
            ]);
        }

        if ($response->getStatusCode() == 200) {
            $responseData = json_decode($response->getBody()->getContents(), true);

            $motion = new Motion();
            $motion->value = $responseData['value'];
            $motion->date = new Carbon($responseData['date']);
            $motion->save();
        } else {
            return back()->withErrors([
                'error' => 'Cisco Packet Tracer response with unknown error!'
            ]);
        }

        return redirect('/sensors/motions');
    }
}

