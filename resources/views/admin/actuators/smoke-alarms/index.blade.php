@extends('layouts.app')

@section('content')

<div class="row d-flex justify-content-end mb-3">
    <div class="col-1">
        <a class="btn btn-outline-secondary btn-sm" href="/actuators" role="button">Voltar</a>
    </div>
</div>

<div class="row d-flex justify-content-center mb-3">
    <div class="actuator-icon-history">
        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-snow"
            viewBox="0 0 16 16">
            <path
                d="M8 16a.5.5 0 0 1-.5-.5v-1.293l-.646.647a.5.5 0 0 1-.707-.708L7.5 12.793V8.866l-3.4 1.963-.496 1.85a.5.5 0 1 1-.966-.26l.237-.882-1.12.646a.5.5 0 0 1-.5-.866l1.12-.646-.884-.237a.5.5 0 1 1 .26-.966l1.848.495L7 8 3.6 6.037l-1.85.495a.5.5 0 0 1-.258-.966l.883-.237-1.12-.646a.5.5 0 1 1 .5-.866l1.12.646-.237-.883a.5.5 0 1 1 .966-.258l.495 1.849L7.5 7.134V3.207L6.147 1.854a.5.5 0 1 1 .707-.708l.646.647V.5a.5.5 0 1 1 1 0v1.293l.647-.647a.5.5 0 1 1 .707.708L8.5 3.207v3.927l3.4-1.963.496-1.85a.5.5 0 1 1 .966.26l-.236.882 1.12-.646a.5.5 0 0 1 .5.866l-1.12.646.883.237a.5.5 0 1 1-.26.966l-1.848-.495L9 8l3.4 1.963 1.849-.495a.5.5 0 0 1 .259.966l-.883.237 1.12.646a.5.5 0 0 1-.5.866l-1.12-.646.236.883a.5.5 0 1 1-.966.258l-.495-1.849-3.4-1.963v3.927l1.353 1.353a.5.5 0 0 1-.707.708l-.647-.647V15.5a.5.5 0 0 1-.5.5z" />
        </svg> --}}
        <i class="fas fa-smog"></i>
    </div>
</div>

@foreach ($list as $group)
<div class="row d-flex justify-content-center align-items-center">

    @foreach ($group as $sa)
    <div class="col-md-4 col-sm-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title text-left">
                    {{ $sa['name'] }}
                </h5>
                <p class="text-right mb-0">
                    <span class="text-muted small">Operação em modo {{ $sa['automatic'] ? 'Automático' : 'Manual' }}</span>
                    <i class="bi bi-{{ $sa['automatic'] ? 'play-circle' : 'stop-circle' }} text-muted" title="{{ $sa['automatic'] ? 'Operando Automaticamente' : 'Operando Manualmente' }}"></i>
                </p>
                <p class="text-right mb-0">
                    <span class="text-muted small">Programado para: {{ $sa['setting'] }} %</span>
                </p>
                <p class="text-right">
                    <span class="text-muted small">Fumaça no ambiente: {{ $sa['value'] }} %</span>
                </p>
                <p class="d-flex justify-content-between" title="{{ $sa['state'] ? 'Ligado' : 'Desligado' }}">
                    <span>Estado:</span>
                    {!! !$sa['state'] ?
                    '<i class="far fa-smile text-success" title="Alarme Desligado"></i>' :
                    '<i class="fas fa-skull-crossbones text-danger" title="Alarme Ligado"></i>' !!}
                </p>
                <p class="d-flex justify-content-between">
                    <a href="/actuators/smoke-alarms/{{ $sa['id'] }}" class="btn btn-outline-primary btn-sm">
                        <span class="small"><i>histórico</i></span>
                    </a>

                    @if (Auth::user()->role === 'admin')
                    <a href="/actuators/smoke-alarms/{{ $sa['id'] }}/edit" class="btn btn-outline-secondary btn-sm">
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
