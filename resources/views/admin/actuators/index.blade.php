@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="list-group">
            <a href="/actuators/blinds" class="list-group-item list-group-item-action d-flex justify-content-between"
                aria-current="true">
                <span>Persianas</span>
                <i class="fas fa-sliders-h"></i>
            </a>
            <a href="/actuators/air-conditioners"
                class="list-group-item list-group-item-action d-flex justify-content-between">
                <span>Ar Condicionado</span>
                <i class="bi bi-snow"></i>
            </a>
            <a href="/actuators/sprinklers" class="list-group-item list-group-item-action d-flex justify-content-between">
                <span>Aspersores</span>
                <i class="fas fa-faucet"></i>
            </a>
            <a href="/actuators/smoke-alarms" class="list-group-item list-group-item-action d-flex justify-content-between">
                <span>Alarmes de fumaça</span>
                <i class="fas fa-smog"></i>
            </a>
            <a href="/actuators/doors" class="list-group-item list-group-item-action d-flex justify-content-between">
                <span>Portas</span>
                <i class="bi bi-door-closed"></i>
            </a>
            <a href="/actuators/lamps" class="list-group-item list-group-item-action d-flex justify-content-between">
                <span>Lâmpadas</span>
                <i class="bi bi-lightbulb"></i>
            </a>
        </div>
    </div>
</div>
@endsection
