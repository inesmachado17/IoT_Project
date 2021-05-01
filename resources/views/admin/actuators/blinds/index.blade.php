@extends('layouts.app')

@section('content')

<div class="row justify-content-end">
    <div class="col-1">
        <a class="btn btn-outline-secondary btn-sm" href="/actuators" role="button">Voltar</a>
    </div>
</div>

<div class="row">
    <div class="col-8 offset-2">
        <p>Lista de Persianas cadastradas</p>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Designação</th>
                    <th class="text-center">Abertura</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($blinds as $blind)
                <tr>
                    <td>{{ $blind['name'] }}</td>
                    <td class="text-center">{{ $blind['state'] }} %</td>
                    <td class="text-center">
                        <a href="{{ url('/actuators/blinds/'. $blind['id'] . '/edit') }}"
                            class="btn btn-outline-secondary btn-sm" role="button" aria-pressed="true">
                            <i class="bi bi-gear"></i>
                        </a>
                        <a href="{{ url('/actuators/blinds/'. $blind['id']) }}" class="btn btn-outline-primary btn-sm"
                            role="button" aria-pressed="true">
                            <span class="small"><i>histórico</i></span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row">
            <div class="col d-flex justify-content-center">
                <a href="{{ $prev }}" class="btn btn-primary btn-sm {{ $prev == null ? 'disabled' : '' }}" role="button"
                    aria-pressed="true" aria-disabled="{{ $prev == null ? 'true' : 'false' }}">Anterior</a>
                <a href="{{ $next }}" class="btn btn-primary btn-sm ml-2 {{ $next == null ? 'disabled' : '' }}"
                    role="button" aria-pressed="true" aria-disabled="{{ $next == null }}">Proximo</a>
            </div>
        </div>
    </div>
</div>

@endsection
