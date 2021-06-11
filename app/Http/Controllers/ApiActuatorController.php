<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AirConditioner;
use App\Models\Blind;
use App\Models\Lamp;
use App\Models\SmokeAlarm;
use App\Models\Sprinkler;
use Illuminate\Support\Facades\Validator;

class ApiActuatorController extends Controller
{

    private $validatorMap = [
        'air-conditioners' => [
            "id"    => "required|exists:air_conditioners,id",
            "state" => "required|boolean",
            "value" => 'required|numeric',
        ],
        'sprinklers' => [
            "id"    => "required|exists:sprinklers,id",
            "state" => "required|boolean",
            "value" => 'required|numeric',
        ],
        'lamps' => [
            "id"    => "required|exists:lamps,id",
            "state" => "required|boolean",
            "value" => 'required|numeric',
        ],
        'smoke-alarms' => [
            "id"    => "required|exists:smoke_alarms,id",
            "state" => "required|boolean",
            "value" => 'required|numeric',
        ],
        'blinds' => [
            "id"      => "required|exists:blinds,id",
            "state"   => "required|boolean",
            "value"   => "required|numeric|min:0|max:100",
        ]
    ];

    private $modelMap = [
        'air-conditioners'  => AirConditioner::class,
        'sprinklers'        => Sprinkler::class,
        'lamps'             => Lamp::class,
        'smoke-alarms'      => SmokeAlarm::class,
        'blinds'            => Blind::class,
    ];

    public function update(Request $request, $actuatorName)
    {

        if (!array_key_exists($actuatorName, $this->modelMap)) {
            return response("Actuator name not recognized", 400);
        }

        $validator = Validator::make($request->all(), $this->validatorMap[$actuatorName]);

        if ($validator->fails()) {
            return response($validator->messages(), 400);
        }

        try {
            $actuator = (new $this->modelMap[$actuatorName]())->find($request["id"]);
            $actuator->state = $request['state'];
            $actuator->value = $request['value'];

            $actuator->save();
        } catch (\Exception $exception) {
            return response($exception->getMessage(), 500);
        }

        return response('', 204);
    }

    public function index(Request $request, $actuatorName)
    {

        if (!array_key_exists($actuatorName, $this->modelMap)) {
            return response("Actuator name not recognized", 400);
        }

        $list = (new $this->modelMap[$actuatorName]())->orderBy('id', 'asc')->get();

        return response($list, 200);
    }
}
