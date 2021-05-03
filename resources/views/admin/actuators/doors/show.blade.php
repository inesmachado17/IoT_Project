@extends('layouts.app')

@section('content')

<div class="row d-flex justify-content-center mb-3">
    <div class="col-6 d-flex justify-content-between">
        <a class="btn btn-outline-secondary btn-sm" href="/actuators/doors" role="button">Voltar</a>
    </div>
</div>

<div class="row d-flex justify-content-center mb-5">
    <div class="col-6">
        <p class="d-flex justify-content-between">
            <span class="h2">{{ $door->name }}</span>
            <span class="d-flex align-items-center">
                <i class="text-muted small mr-2">(total de visitas)</i>
                {{ $door->history->count() }}
            </span>
        </p>
        <p>Atualmente:
            <span class="h3 mx-2">
                <i
                    class="bi bi-door-{{ $door->state ? 'open' : 'closed' }} {{ $door->state ? 'text-success' : 'text-danger' }}"
                    title="{{ $door->state ? 'Porta aberta' : 'Porta fechada' }}">

                </i>
            </span>
            <span class="h3">
                <i
                    class="bi bi-{{$door->locked ? 'lock' : 'unlock' }}"
                    title="{{$door->locked ? 'Fecho ativado' : 'Fecho desativado' }}">
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
                    <th class="text-center">Presença</th>
                    <th class="text-center">Aberta?</th>
                    <th class="text-center">Fecho central ativado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($door->history as $history)
                <tr>
                    <td class="text-center">{{ $history->created_at->setTimezone('Europe/Lisbon') }}</td>
                    <td class="text-center">
                        {!! $history->presence ? '<i class="bi bi-person-check text-success"></i>' : '<i
                            class="bi bi-person-x text-danger"></i>' !!}
                    </td>
                    <td class="text-center">
                        <i
                            class="bi bi-door-{{ $history->state ? 'open' : 'closed' }} {{ $history->state ? 'text-success' : 'text-danger' }}"></i>
                    </td>
                    <td class="text-center">
                        <i class="bi bi-{{ $history->locked ? 'play' : 'pause' }}"></i>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
