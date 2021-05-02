@extends('layouts.app')

@section('content')

<div class="row d-flex justify-content-center mb-3">
    <div class="col-6 d-flex justify-content-between">
        <a class="btn btn-outline-secondary btn-sm" href="/actuators/doors" role="button">Voltar</a>
    </div>
</div>

<div class="row d-flex justify-content-center mb-5">
    <div class="col-6">
        <h2>{{ $door->name }}</h2>
        <p>Atualmente:
            <span class="h3 mx-2">{{ $door->state }} <i class="bi bi-person-bounding-box" small></i></span>
            <span class="h3">
                <i class="bi bi-door-closed {{ $door->state ? 'text-success' : 'text-danger' }}"></i>
            </span>
        </p>
    </div>
</div>

<div class="row d-flex justify-content-center">
    <div class="col-6">
        <p>Listagem das últimas 30 alterações</p>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center">Data</th>
                    <th class="text-center">Presença</th>
                    <th class="text-center">Autorização</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($door->history as $history)
                <tr>
                    <td class="text-center">{{ $history->created_at->setTimezone('Europe/Lisbon') }}</td>
                    <td class="text-right">{{ $history->state }}<i class="bi bi-person-bounding-box"></i></td>
                    <td class="text-right">
                        <i class="bi bi-door-closed {{ $history->auth ? 'text-success' : 'text-danger' }}"></i>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
