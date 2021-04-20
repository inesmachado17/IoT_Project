<?php


namespace App\Http\Controllers\Sensor;

use App\Models\Light;

class SensorLightController
{
    public function index()
    {
        $pagination = (new Light())
            ->latest()
            ->paginate(5);


        return view('sensors.light.list', ['list' => $pagination]);
    }
}
