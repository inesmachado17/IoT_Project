@extends('layouts.app')

@section('content')

<div class="row mb-3">
    <div class="col-1 offset-1">
        <a class="btn btn-outline-secondary btn-sm" href="/sensors/temperatures/force-update" role="button"
            title="Atualização forçada">
            <i class="bi bi-arrow-repeat"></i>
        </a>
    </div>
    <div class="col-1 offset-8">
        <a class="btn btn-outline-secondary btn-sm" href="{{ url()->previous() }}" role="button">Voltar</a>
    </div>
</div>

<div class="row">
    <div class="col-10 offset-1">
        <p>Histórico de leituras</p>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($temperatures as $temp)
                <tr>
                    <td>{{ $temp['date'] }}</td>
                    <td>{{ $temp['value'] }}</td>
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

<div class="row justify-content-end">
    <div class="col-1">

    </div>
</div>

@endsection
