<?php

namespace App\Http\Controllers;

use App\Models\Sensors\Humidity;
use App\Models\Sensors\Light;
use App\Models\Sensors\Motion;
use App\Models\Sensors\Smoke;
use App\Models\Sensors\Temperature;

class DashboardController extends Controller
{

    public function index()
    {
        $lastTemperature = (new Temperature())->orderBy('date', 'desc')->first();
        $lastHumidity = (new Humidity())->orderBy('date', 'desc')->first();
        $lastLight = (new Light())->orderBy('date', 'desc')->first();
        $lastSmoke = (new Smoke())->orderBy('date', 'desc')->first();
        $lastMotion = (new Motion())->orderBy('date', 'desc')->first();

        return view('admin.dashboard.index', [
            'data' => [
                'temperature'   => $lastTemperature,
                'humidity'      => $lastHumidity,
                'light'         => $lastLight,
                'smoke'         => $lastSmoke,
                'motion'         => $lastMotion
            ]
        ]);
    }
}
