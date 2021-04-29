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
            ->all()->toArray();

        //[1,2,3,4,5]

        $list = array_chunk($airConditioners, 3);

        /* [
            0 => [1, 2, 3],
            1 => [4, 5]
        ] */

        return view('admin.actuators.air-conditioners.index', ['list' => $list]);
    }
}
