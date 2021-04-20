<?php

namespace App\Http\Controllers\Actuator;

use App\Http\Controllers\Controller;
use App\Models\Door;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActuatorDoorController extends Controller
{
    public function index()
    {
        $pagination = (new Door())
            ->latest()
            ->paginate(5);


        return view('actuators.doors.list', ['list' => $pagination]);
    }
}
