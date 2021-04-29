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
        $airConditioners = (new AirConditioner())
            ->all();

        $list = array_chunk($airConditioners->toArray(), 3);

        return view('admin.actuators.air-conditioners.index', ['list' => $list]);
    }
}
