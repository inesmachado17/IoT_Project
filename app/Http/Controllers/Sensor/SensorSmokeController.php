<?php


namespace App\Http\Controllers\Sensor;

use App\Http\Controllers\Controller;
use App\Models\Smoke;

class SensorSmokeController extends Controller
{
    public function index()
    {
        $pagination = (new Smoke())
            ->latest()
            ->paginate(5);


        return view('sensors.smoke.list', ['list' => $pagination]);
    }
}
