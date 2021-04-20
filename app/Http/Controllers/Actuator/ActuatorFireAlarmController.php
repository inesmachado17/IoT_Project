<?php

namespace App\Http\Controllers\Actuator;

use App\Http\Controllers\Controller;
use App\Models\FireAlarm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActuatorFireAlarmController extends Controller
{
    public function index()
    {
        $pagination = (new FireAlarm())
            ->latest()
            ->paginate(5);


        return view('actuators.fire_alarms.list', ['list' => $pagination]);
    }
}
