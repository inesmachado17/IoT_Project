<?php

namespace App\Http\Controllers\Actuator;

use App\Http\Controllers\Controller;
use App\Models\Blind;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActuatorBlindController extends Controller
{
    public function index(Request $request)
    {
        $pagination = (new Blind())
            ->latest()
            ->paginate(5)
            ->toArray();

        return view('actuators.blinds.index', [
            'blinds'    => $pagination['data'],
            'prev'      => $pagination['prev_page_url'],
            'next'      => $pagination['next_page_url'],
        ]);
    }

    public function edit($id)
    {
        $blind = (new Blind())->find($id);

        if($blind != null) {
            return view('actuators.blinds.edit', ['blind'    => $blind]);
        }

        return back()->withErrors([
            'error' => 'Blind id not found'
        ]);
    }
}
