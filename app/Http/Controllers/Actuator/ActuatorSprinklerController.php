<?php

namespace App\Http\Controllers\Actuator;

use App\Http\Controllers\Controller;
use App\Models\Sprinkler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActuatorSprinklerController extends Controller
{
    public function index()
    {
        $pagination = (new Sprinkler())
            ->latest()
            ->paginate(5);


        return view('actuators.sprinklers.list', ['list' => $pagination]);
    }
}
