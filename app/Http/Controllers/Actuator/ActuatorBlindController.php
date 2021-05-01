<?php

namespace App\Http\Controllers\Actuator;

use App\Http\Controllers\Controller;
use App\Models\Blind;
use App\Models\BlindState;
use Illuminate\Http\Request;
use GuzzleHttp;

class ActuatorBlindController extends Controller
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

        //dd($blind);

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
            'id'    => 'required|exists:blinds,id',
            'name'  => 'required|string',
            'state' => 'required|numeric|min:0|max:100'
        ]);

        $blind = (new Blind())->findOrFail($id);
        $blind->name = $request['name'];

        if ($blind->state != $request['state']) {
            //Enviar ao cisco packet tracer o pedido de alteração de state
            //para esta persiana o cisco reponde ok ou error
            //no caso de ok atualiza o state desta persiana no banco de dados
            $client = new GuzzleHttp\Client();

            try {
                $response = $client->post(env('APP_API_BASE_URL') . '/actuators/blinds', [
                    'code'  => $id,
                    'state' => $request['state']
                ]); //['auth' =>  ['user', 'pass']]
            } catch (\Exception $exception) {
                return back()->withErrors([
                    'error' => 'Cisco Packet Tracer reponde with unknown error!'
                ]);
            }

            if ($response->getStatusCode() == 200 || $response->getStatusCode() == 204) {
                $blind->state = $request['state'];
            } else {
                return back()->withErrors([
                    'error' => 'Cisco Packet Tracer reponde with unknown error!'
                ]);
            }
        }

        $blindState = new BlindState();
        $blindState->state = $blind->state;
        $blindState->blind_id = $blind->id;
        $blindState->save();
        $blind->save();

        return redirect($request['return_to'] ?? '/actuators/blinds');
    }
}
