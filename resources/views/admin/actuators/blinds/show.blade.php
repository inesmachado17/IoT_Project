@extends('layouts.app')

@section('content')

<div class="row d-flex justify-content-center mb-3">
    <div class="col-6 d-flex justify-content-between">
        <a class="btn btn-outline-secondary btn-sm" href="{{ $returnUrl }}" role="button">Voltar</a>
    </div>
</div>

<div class="row d-flex justify-content-center mb-5">
    <div class="col-6">
        <h2>{{ $blind->name }}</h2>
        <p>Estado atual de abertura: <span class="h3">{{ $blind->state }} %</span></p>
    </div>
</div>

<div class="row d-flex justify-content-center">
    <div class="col-6">
        <p>Listagem das últimas 30 alterações</p>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center">Data</th>
                    <th class="text-center">Abertura</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blind->history as $history)
                <tr>
                    <td class="text-center">{{ $history->created_at->setTimezone('Europe/Lisbon') }}</td>
                    <td class="text-right">{{ $history->state }} %</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
