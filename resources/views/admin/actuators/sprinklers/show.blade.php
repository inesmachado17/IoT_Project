@extends('layouts.app')

@section('content')

<div class="row d-flex justify-content-center mb-3">
    <div class="col-6 d-flex justify-content-between">
        <a class="btn btn-outline-secondary btn-sm" href="/actuators/sprinklers" role="button">Voltar</a>
    </div>
</div>

<div class="row d-flex justify-content-center mb-5">
    <div class="col-6">
        <h2>{{ $sprinkler->name }}</h2>
        <p>Atualmente:
            <span class="h3 mx-2">{{ $sprinkler->timer }} <i class="bi bi-stopwatch small" title="minutos"></i></span>
            <span class="h3">
                <i
                    class="bi bi-power {{ $sprinkler->state ? 'text-success' : 'text-danger' }}"
                    title="{{ $sprinkler->state ? 'Ligado' : 'Desligado' }}">
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
                    <th class="text-center">Tempo</th>
                    <th class="text-center">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sprinkler->history as $history)
                <tr>
                    <td class="text-center">{{ $history->created_at->setTimezone('Europe/Lisbon') }}</td>
                    <td class="text-right">{{ $history->timer }}<i class="bi bi-stopwatch" title="minutos"></i></td>
                    <td class="text-right">
                        <i
                            class="bi bi-power {{ $history->state ? 'text-success' : 'text-danger' }}"
                            title="{{ $history->state ? 'Ligado' : 'Desligado' }}">
                        </i>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
