@extends('layouts.app')

@section('content')

<div class="row d-flex justify-content-end mb-3">
    <div class="col-1">
        <a class="btn btn-outline-secondary btn-sm" href="/actuators" role="button">Voltar</a>
    </div>
</div>

<div class="row d-flex justify-content-center mb-3">
    <div class="actuator-icon-history">
        <i class="fas fa-faucet"></i>
    </div>
</div>

@foreach ($list as $group)
<div class="row d-flex justify-content-center align-items-center">

    @foreach ($group as $sprinkler)
    <div class="col-md-4 col-sm-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title text-left">
                    {{ $sprinkler['name'] }}
                </h5>
                <p class="text-right mb-0">
                    <span class="text-muted small">Operação em modo {{ $sprinkler['automatic'] ? 'Automático' : 'Manual' }}</span>
                    <i class="bi bi-{{ $sprinkler['automatic'] ? 'play-circle' : 'stop-circle' }} text-muted" title="{{ $sprinkler['automatic'] ? 'Operando Automaticamente' : 'Operando Manualmente' }}"></i>
                </p>
                <p class="text-right mb-0" title="minutos">
                    <span class="text-muted small">Programado para: {{ $sprinkler['setting'] }}
                       % <i class="bi bi-moisture"></i>
                    </span>
                </p>
                <p class="text-right">
                    <span class="text-muted small">
                        Humidade das proximidades: {{ $sprinkler['value'] }} %
                        <i class="bi bi-moisture"></i>
                    </span>
                </p>
                <p class="d-flex justify-content-between" title="{{ $sprinkler['state'] ? 'Ligado' : 'Desligado' }}">
                    <span>Estado:</span>
                    <i
                        class="bi bi-power {{ $sprinkler['state'] ? 'text-success' : 'text-danger' }}"
                        title="{{ $sprinkler['state'] ? 'Ligado' : 'Desligado' }}"
                    ></i>
                </p>
                <p class="d-flex justify-content-between">
                    <a href="/actuators/sprinklers/{{ $sprinkler['id'] }}" class="btn btn-outline-primary btn-sm">
                        <span class="small"><i>histórico</i></span>
                    </a>
                    @if (Auth::user()->role === 'admin')
                    <a href="/actuators/sprinklers/{{ $sprinkler['id'] }}/edit"
                        class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-gear" title="Configurar"></i>
                    </a>
                    @endif
                </p>
            </div>
        </div>
    </div>
    @endforeach

</div>
@endforeach



@endsection
