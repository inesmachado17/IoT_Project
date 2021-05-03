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
        <p>Atualmente:
            <span class="h3 mx-2">{{ $airConditioner->setting }} ºC</span>
            <span class="h3">
                <i
                    class="bi bi-power {{ $airConditioner->state ? 'text-success' : 'text-danger' }}"
                    title="{{ $airConditioner->state ? 'Ligado' : 'Desligado' }}">
                </i>
            </span>
        </p>
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
