<?php


namespace App\Http\Controllers\Sensor;

use App\Models\Humidity;

class SensorHumidityController
{
    public function index()
    {
        $pagination = (new Humidity())
            ->latest()
            ->paginate(5);


        return view('sensors.humidity.list', ['list' => $pagination]);
    }
}
