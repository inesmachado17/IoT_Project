<?php

namespace App\Http\Controllers\Actuator;

use App\Http\Controllers\Controller;

class ActuatorController extends Controller
{
    public function index()
    {
        return view('admin.actuators.index');
    }
}
