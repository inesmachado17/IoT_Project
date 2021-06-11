@extends('layouts.app')

@section('content')

<div class="row justify-content-end">
    <div class="col-1">
        <a class="btn btn-outline-secondary btn-sm" href="/actuators" role="button">Voltar</a>
    </div>
</div>

<div class="row d-flex justify-content-center mb-3">
    <div class="actuator-icon-history">
        <i class="bi bi-lightbulb"></i>
    </div>
</div>

<div class="row">
    <div class="col-8 offset-2">
        <p>As Minhas Lâmpadas</p>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th rowspan="2" class="text-center">Designação</th>
                    <th colspan="2" class="text-center">Luminosidade</th>
                    <th rowspan="2" class="text-center center">Estado</th>
                    <th rowspan="2" class="text-center">Modo Operação</th>
                    <th rowspan="2"></th>
                </tr>
                <tr>
                    <th class="text-center small">programada</th>
                    <th class="text-center small">ambiente</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lamps as $lamp)
                <tr>
                    <td>{{ $lamp['name'] }}</td>
                    <td class="text-center">{{ $lamp['setting'] }} %</td>
                    <td class="text-center">{{ $lamp['value'] }} %</td>
                    <td class="text-center">
                        {!! $lamp['state'] ? '<i class="bi bi-lightbulb text-success" title="Ligado"></i>' : '<i
                            class="bi bi-lightbulb-off text-danger" title="Desligado"></i>' !!}
                    </td>
                    <td class="text-center">
                        <i
                        class="bi bi-{{ $lamp['automatic'] ? 'play-circle' : 'stop-circle' }} text-muted"
                        title="{{ $lamp['automatic'] ? 'Automático' : 'Manual' }}">
                    </i>
                    </td>
                    <td class="text-center">
                        @if (Auth::user()->role === 'admin')
                        <a href="{{ url('/actuators/lamps/'. $lamp['id'] . '/edit') }}"
                            class="btn btn-outline-secondary btn-sm" role="button" aria-pressed="true">
                            <i class="bi bi-gear" title="Configurar"></i>
                        </a>
                        @endif
                        <a href="{{ url('/actuators/lamps/'. $lamp['id']) }}" class="btn btn-outline-primary btn-sm"
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
                    role="button" aria-pressed="true" aria-disabled="{{ $next == null ? 'true' : 'false' }}">Proximo</a>
            </div>
        </div>
    </div>
</div>

@endsection
