<?php

namespace App\Http\Controllers\Actuator;

use App\Http\Controllers\Controller;
use App\Models\Blind;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActuatorBlindController extends Controller
{
    public function index()
    {
        $pagination = (new Blind())
            ->latest()
            ->paginate(5);


        return view('actuators.blinds.list', ['list' => $pagination]);
    }
}
