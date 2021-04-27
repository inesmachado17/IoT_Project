<?php

namespace App\Http\Controllers;

use App\Models\Humidity;
use App\Models\Light;
use App\Models\Motion;
use App\Models\Smoke;
use App\Models\Temperature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index(Request $request)
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
