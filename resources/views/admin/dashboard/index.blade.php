@extends('layouts.app')

@section('content')


<div class="row">
    <div class="col-4">
        <div class="card h-100">
            <img src="imgs/temp_1.jpg" class="card-img-top" alt="Termômetro">
            <div class="card-body">
                <h5 class="card-title text-center">Temperatura</h5>
                <p class="card-text text-center mb-1">
                    <span class="h5">{{ $data['temperature']->value }} ºC</span>
                </p>
                <p class="text-muted text-center small">
                    {{ $data['temperature']->date }}
                </p>
                <a href="sensors/temperatures" class="btn btn-primary btn-sm">Abrir histórico</a>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <img src="imgs/temp_1.jpg" class="card-img-top" alt="Humidificador">
            <div class="card-body">
                <h5 class="card-title text-center">Humidade</h5>
                <p class="card-text text-center mb-1">
                    <span class="h5">{{ $data['humidity']->value }}%</span>
                </p>
                <p class="text-muted text-center small">
                    {{ $data['humidity']->date }}
                </p>
                <a href="sensors/humidities" class="btn btn-primary btn-sm">Abrir histórico</a>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <img src="imgs/temp_1.jpg" class="card-img-top" alt="Termômetro">
            <div class="card-body">
                <h5 class="card-title text-center">Luz</h5>
                <p class="card-text text-center mb-1">
                    <span class="h5">{{ $data['light']}}</span>
                </p>
                <p class="text-muted text-center small">
                    {{ $data['temperature']->date }}
                </p>
                <a href="#" class="btn btn-primary btn-sm">Abrir histórico</a>
            </div>
        </div>
    </div>
</div>

@endsection
