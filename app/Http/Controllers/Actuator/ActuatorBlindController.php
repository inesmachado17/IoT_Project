<?php

namespace App\Http\Controllers\Actuator;

use App\Http\Controllers\AdminController;
use App\Models\Blind;
use App\Models\BlindState;
use Illuminate\Http\Request;
use GuzzleHttp;

class ActuatorBlindController extends AdminController
{
    public function index()
    {
        $pagination = (new Blind())
            ->orderBy('name')
            ->paginate(10)
            ->toArray();

        return view('admin.actuators.blinds.index', [
            'blinds'    => $pagination['data'],
            'prev'      => $pagination['prev_page_url'],
            'next'      => $pagination['next_page_url'],
        ]);
    }

    public function show(Request $request, $id)
    {
        $returnUrl = $request->getSession()->previousUrl();

        $blind = (new Blind())->with('history')->find($id);

        if ($blind == null) {
            return back()->withErrors([
                'error' => 'Blind id not found'
            ]);
        }

        return view('admin.actuators.blinds.show', ['blind'    => $blind, 'returnUrl' => $returnUrl]);
    }

    public function edit(Request $request, $id)
    {
        $returnUrl = $request->getSession()->previousUrl();

        $blind = (new Blind())->find($id);

        if ($blind != null) {
            return view('admin.actuators.blinds.edit', ['blind'    => $blind, 'returnUrl' => $returnUrl]);
        }

        return back()->withErrors([
            'error' => 'Blind id not found'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->merge(['id' => $id]);
        $request->validate([
            'id'      => 'required|exists:blinds,id',
            'name'    => 'required|string',
            'setting' => 'required|numeric|min:0|max:100'
        ]);

        $blind = (new Blind())->findOrFail($id);
        $blind->name = $request['name'];
        $blind->setting = $request['setting'];


        $blindState = new BlindState();
        $blindState->value = $blind->value;
        $blindState->blind_id = $blind->id;
        $blindState->save();

        $blind->save();

        return redirect($request['return_to'] ?? '/actuators/blinds');
    }
}
