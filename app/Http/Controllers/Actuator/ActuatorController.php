<?php

namespace App\Http\Controllers\Actuator;

use App\Http\Controllers\AdminController;

class ActuatorController extends AdminController
{
    public function index()
    {
        return view('admin.actuators.index');
    }
}
