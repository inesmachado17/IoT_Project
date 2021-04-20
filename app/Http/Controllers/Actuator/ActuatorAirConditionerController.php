<?php

namespace App\Http\Controllers\Actuator;

use App\Http\Controllers\Controller;
use App\Models\AirConditioner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ActuatorAirConditionerController extends Controller
{
    public function index()
    {
        $pagination = (new AirConditioner())
            ->latest()
            ->paginate(5);


        return view('actuators.air_conditioners.list', ['list' => $pagination]);
    }
}
