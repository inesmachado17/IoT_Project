@extends('layouts.app')

@section('content')

<div class="row d-flex justify-content-center mb-3">
    <div class="col-6 d-flex justify-content-between">
        <a class="btn btn-outline-secondary btn-sm" href="{{ $returnUrl }}" role="button">Voltar</a>
    </div>
</div>

<div class="row d-flex justify-content-center mb-5">
    <div class="col-6">
        <h2>{{ $lamp->name }}</h2>
        <p>Atualmente: <span class="h3">{{ $lamp->setting }}% </span>
            <span class="h5">luminosidade</span>
            <span class="ml-2">
                {!! $lamp['state'] ? '<i class="bi bi-lightbulb text-success" title="Ligado"></i>' :
                    '<i class="bi bi-lightbulb-off text-danger" title="Desligado"></i>' !!}
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
                    <th class="text-center">Luminosidade</th>
                    <th class="text-center">Ligado/Desligado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lamp->history as $history)
                <tr>
                    <td class="text-center">{{ $history->created_at->setTimezone('Europe/Lisbon') }}</td>
                    <td class="text-center">{{ $history->setting }} %</td>
                    <td class="text-center">
                        {!! $history->state ? '<i class="bi bi-lightbulb text-success"></i>' : '<i
                            class="bi bi-lightbulb-off text-danger"></i>' !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
