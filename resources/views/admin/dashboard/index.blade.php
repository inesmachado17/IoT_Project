@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-4">
        <div class="card h-100">
            <div class="sensor-icon-dashboard">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-thermometer-half" viewBox="0 0 16 16">
                    <path d="M9.5 12.5a1.5 1.5 0 1 1-2-1.415V6.5a.5.5 0 0 1 1 0v4.585a1.5 1.5 0 0 1 1 1.415z" />
                    <path
                        d="M5.5 2.5a2.5 2.5 0 0 1 5 0v7.55a3.5 3.5 0 1 1-5 0V2.5zM8 1a1.5 1.5 0 0 0-1.5 1.5v7.987l-.167.15a2.5 2.5 0 1 0 3.333 0l-.166-.15V2.5A1.5 1.5 0 0 0 8 1z" />
                </svg>
            </div>
            <div class="card-body">
                <h5 class="card-title text-center">Temperatura</h5>
                <p class="card-text text-center mb-1">
                    <span class="h5">{{ $data['temperature']->value }} ºC</span>
                </p>
                <p class="text-muted text-center small">
                    {{ (new \Carbon\Carbon($data['temperature']->date))->setTimezone('Europe/Lisbon') }}
                </p>
                <a href="sensors/temperatures" class="btn btn-primary btn-sm">Abrir histórico</a>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="sensor-icon-dashboard">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-moisture" viewBox="0 0 16 16">
                    <path
                        d="M13.5 0a.5.5 0 0 0 0 1H15v2.75h-.5a.5.5 0 0 0 0 1h.5V7.5h-1.5a.5.5 0 0 0 0 1H15v2.75h-.5a.5.5 0 0 0 0 1h.5V15h-1.5a.5.5 0 0 0 0 1h2a.5.5 0 0 0 .5-.5V.5a.5.5 0 0 0-.5-.5h-2zM7 1.5l.364-.343a.5.5 0 0 0-.728 0l-.002.002-.006.007-.022.023-.08.088a28.458 28.458 0 0 0-1.274 1.517c-.769.983-1.714 2.325-2.385 3.727C2.368 7.564 2 8.682 2 9.733 2 12.614 4.212 15 7 15s5-2.386 5-5.267c0-1.05-.368-2.169-.867-3.212-.671-1.402-1.616-2.744-2.385-3.727a28.458 28.458 0 0 0-1.354-1.605l-.022-.023-.006-.007-.002-.001L7 1.5zm0 0-.364-.343L7 1.5zm-.016.766L7 2.247l.016.019c.24.274.572.667.944 1.144.611.781 1.32 1.776 1.901 2.827H4.14c.58-1.051 1.29-2.046 1.9-2.827.373-.477.706-.87.945-1.144zM3 9.733c0-.755.244-1.612.638-2.496h6.724c.395.884.638 1.741.638 2.496C11 12.117 9.182 14 7 14s-4-1.883-4-4.267z" />
                </svg>
            </div>
            <div class="card-body">
                <h5 class="card-title text-center">Humidade</h5>
                <p class="card-text text-center mb-1">
                    <span class="h5">{{ $data['humidity']->value }}%</span>
                </p>
                <p class="text-muted text-center small">
                    {{ (new \Carbon\Carbon($data['humidity']->date))->setTimezone('Europe/Lisbon') }}
                </p>
                <a href="sensors/humidities" class="btn btn-primary btn-sm">Abrir histórico</a>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="sensor-icon-dashboard">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-thermometer-sun" viewBox="0 0 16 16">
                    <path d="M5 12.5a1.5 1.5 0 1 1-2-1.415V2.5a.5.5 0 0 1 1 0v8.585A1.5 1.5 0 0 1 5 12.5z" />
                    <path
                        d="M1 2.5a2.5 2.5 0 0 1 5 0v7.55a3.5 3.5 0 1 1-5 0V2.5zM3.5 1A1.5 1.5 0 0 0 2 2.5v7.987l-.167.15a2.5 2.5 0 1 0 3.333 0L5 10.486V2.5A1.5 1.5 0 0 0 3.5 1zm5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0v-1a.5.5 0 0 1 .5-.5zm4.243 1.757a.5.5 0 0 1 0 .707l-.707.708a.5.5 0 1 1-.708-.708l.708-.707a.5.5 0 0 1 .707 0zM8 5.5a.5.5 0 0 1 .5-.5 3 3 0 1 1 0 6 .5.5 0 0 1 0-1 2 2 0 0 0 0-4 .5.5 0 0 1-.5-.5zM12.5 8a.5.5 0 0 1 .5-.5h1a.5.5 0 1 1 0 1h-1a.5.5 0 0 1-.5-.5zm-1.172 2.828a.5.5 0 0 1 .708 0l.707.708a.5.5 0 0 1-.707.707l-.708-.707a.5.5 0 0 1 0-.708zM8.5 12a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0v-1a.5.5 0 0 1 .5-.5z" />
                </svg>
            </div>
            <div class="card-body">
                <h5 class="card-title text-center">Luz</h5>
                <p class="card-text text-center mb-1">
                    <span class="h5">{{ $data['light']->value }}</span>
                </p>
                <p class="text-muted text-center small">
                    {{ (new \Carbon\Carbon($data['light']->date))->setTimezone('Europe/Lisbon') }}
                </p>
                <a href="sensors/lights" class="btn btn-primary btn-sm">Abrir histórico</a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-4 offset-2">
        <div class="card h-100">
            <div class="sensor-icon-dashboard">
                <i class="fas fa-smog"></i>
            </div>
            <div class="card-body">
                <h5 class="card-title text-center">Fumo</h5>
                <p class="card-text text-center mb-1">
                    <span class="h5">{{ $data['smoke']->value }}</span>
                </p>
                <p class="text-muted text-center small">
                    {{ (new \Carbon\Carbon($data['smoke']->date))->setTimezone('Europe/Lisbon') }}
                </p>
                <a href="sensors/smokes" class="btn btn-primary btn-sm">Abrir histórico</a>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="sensor-icon-dashboard">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-broadcast" viewBox="0 0 16 16">
                    <path
                        d="M3.05 3.05a7 7 0 0 0 0 9.9.5.5 0 0 1-.707.707 8 8 0 0 1 0-11.314.5.5 0 0 1 .707.707zm2.122 2.122a4 4 0 0 0 0 5.656.5.5 0 1 1-.708.708 5 5 0 0 1 0-7.072.5.5 0 0 1 .708.708zm5.656-.708a.5.5 0 0 1 .708 0 5 5 0 0 1 0 7.072.5.5 0 1 1-.708-.708 4 4 0 0 0 0-5.656.5.5 0 0 1 0-.708zm2.122-2.12a.5.5 0 0 1 .707 0 8 8 0 0 1 0 11.313.5.5 0 0 1-.707-.707 7 7 0 0 0 0-9.9.5.5 0 0 1 0-.707zM10 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0z" />
                </svg>
            </div>
            <div class="card-body">
                <h5 class="card-title text-center">Movimento</h5>
                <p class="card-text text-center mb-1">
                    <span class="h5">{!! $data['motion']->value == 0 ? '<i class="bi bi-person-check"></i>' : '<i
                            class="bi bi-person-x"></i>' !!}</span>
                </p>
                <p class="text-muted text-center small">
                    {{ (new \Carbon\Carbon($data['motion']->date))->setTimezone('Europe/Lisbon') }}
                </p>
                <a href="sensors/motions" class="btn btn-primary btn-sm">Abrir histórico</a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5 webcam-images">
    <div class="col-12">
        <h3>Webcams</h3>
    </div>
    <div class="col-6 d-flex flex-column justify-content-center align-items-center">
        <img src="{{ Storage::url('webcam/images/oneshot/porta.jpg') }}" class="img-thumbnail webcam-image" alt="...">
        <h5>Porta</h5>
    </div>

    <div class="col-6 d-flex flex-column justify-content-center align-items-center">
        <img src="{{ Storage::url('webcam/images/oneshot/garagem.jpg') }}" class="img-thumbnail webcam-image" alt="...">
        <h5>Garagem</h5>
    </div>
</div>
@endsection
