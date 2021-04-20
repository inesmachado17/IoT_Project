<?php


namespace App\Http\Controllers\Sensor;

use App\Http\Controllers\Controller;
use App\Models\Motion;

class SensorMotionController extends Controller
{
    public function index()
    {
        $pagination = (new Motion())
            ->latest()
            ->paginate(5);


        return view('sensors.motion.list', ['list' => $pagination]);
    }
}

