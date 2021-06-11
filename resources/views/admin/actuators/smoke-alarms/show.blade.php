@extends('layouts.app')

@section('content')

<div class="row d-flex justify-content-center mb-3">
    <div class="col-6 d-flex justify-content-between">
        <a class="btn btn-outline-secondary btn-sm" href="/actuators/smoke-alarms" role="button">Voltar</a>
    </div>
</div>

<div class="row d-flex justify-content-center mb-5">
    <div class="col-6">
        <h2>{{ $smokeAlarm->name }}</h2>
        <div class="row">
            <div class="col-6">
                <p>
                    <span class="small text-muted">programado para: </span>{{ $smokeAlarm->setting }} %
                </p>
                <p>
                    <span class="small text-muted">% de fumaça no ambiente: </span>{{ $smokeAlarm->value }} %
                </p>
            </div>
            <div class="col-6">
                <p>
                    <span class="small text-muted">estado: </span>
                    <i class="bi bi-power {{ $smokeAlarm->state ? 'text-success' : 'text-danger' }}"
                        title="{{ $smokeAlarm->state ? 'Ligado' : 'Desligado' }}">
                    </i>
                </p>
                <p>
                    <span class="small text-muted">operação {{ $smokeAlarm->automatic ? 'automático' : 'manual' }}</span>
                    <i class="bi bi-{{ $smokeAlarm->automatic ? 'play-circle' : 'stop-circle' }} text-muted"
                        title="{{ $smokeAlarm->automatic ? 'Automático' : 'Manual' }}">
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
                    <th class="text-center">Porcentagem</th>
                    <th class="text-center">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($smokeAlarm->history as $history)
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
