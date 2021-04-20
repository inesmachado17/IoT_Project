<?php

namespace App\Http\Controllers\Actuator;

use App\Http\Controllers\Controller;
use App\Models\Lamp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActuatorLampController extends Controller
{
    public function index()
    {
        $pagination = (new Lamp())
            ->latest()
            ->paginate(5);


        return view('actuators.lamps.list', ['list' => $pagination]);
    }
}
