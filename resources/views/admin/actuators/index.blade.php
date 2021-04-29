@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col">
        <div class="list-group">
            <a href="/actuators/blinds" class="list-group-item list-group-item-action" aria-current="true">
                Persianas
            </a>
            <a href="/actuators/air-conditioner" class="list-group-item list-group-item-action">Air Condicionado</a>
            <a href="#" class="list-group-item list-group-item-action">Aspersores</a>
            <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
            <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">A
                disabled link item</a>
        </div>
    </div>
</div>
@endsection
