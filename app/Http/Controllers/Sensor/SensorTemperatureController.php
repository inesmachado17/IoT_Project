<?php


namespace App\Http\Controllers\Sensor;

use App\Http\Controllers\Controller;
use App\Models\Temperature;

class SensorTemperatureController extends Controller
{
    public function index()
    {
        $pagination = (new Temperature())
            ->latest()
            ->paginate(5);


        return view('sensors.temperature.list', ['list' => $pagination]);
    }
}
