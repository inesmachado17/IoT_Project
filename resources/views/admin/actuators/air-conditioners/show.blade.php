@extends('layouts.app')

@section('content')

<div class="row d-flex justify-content-center mb-3">
    <div class="col-6 d-flex justify-content-between">
        <a class="btn btn-outline-secondary btn-sm" href="/actuators/air-conditioners" role="button">Voltar</a>
    </div>
</div>

<div class="row d-flex justify-content-center mb-5">
    <div class="col-6">
        <h2>{{ $airConditioner->name }}</h2>
        <div class="row">
            <div class="col-6">
                <p>
                    <span class="small text-muted">programado para: </span>{{ $airConditioner->setting }} ºC
                </p>
                <p>
                    <span class="small text-muted">temperatura ambiente: </span>{{ $airConditioner->value }} ºC
                </p>
            </div>
            <div class="col-6">
                <p>
                    <span class="small text-muted">estado: </span>
                    <i class="bi bi-power {{ $airConditioner->state ? 'text-success' : 'text-danger' }}"
                        title="{{ $airConditioner->state ? 'Ligado' : 'Desligado' }}">
                    </i>
                </p>
                <p>
                    <span class="small text-muted">operação {{ $airConditioner->automatic ? 'automático' : 'manual' }}</span>
                    <i class="bi bi-{{ $airConditioner->automatic ? 'play-circle' : 'stop-circle' }} text-muted"
                        title="{{ $airConditioner->automatic ? 'Automático' : 'Manual' }}">
                    </i>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row d-flex justify-content-center">
    <div class="col-6">
        <p>Últimas alterações</p>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center">Data</th>
                    <th class="text-center">Temperatura</th>
                    <th class="text-center">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($airConditioner->history as $history)
                <tr>
                    <td class="text-center">{{ $history->created_at->setTimezone('Europe/Lisbon') }}</td>
                    <td class="text-right">{{ $history->setting }} ºC</td>
                    <td class="text-right">
                        <i class="bi bi-power {{ $history->state ? 'text-success' : 'text-danger' }}"></i>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
