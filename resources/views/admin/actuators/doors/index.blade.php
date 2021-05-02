@extends('layouts.app')

@section('content')

<div class="row d-flex justify-content-end mb-3">
    <div class="col-1">
        <a class="btn btn-outline-secondary btn-sm" href="/actuators" role="button">Voltar</a>
    </div>
</div>

<div class="row d-flex justify-content-center mb-3">
    <div class="actuator-icon-history">
        <i class="bi bi-door-closed"></i>
    </div>
</div>

@foreach ($list as $group)
<div class="row d-flex justify-content-center align-items-center">

    @foreach ($group as $door)
    <div class="col-md-4 col-sm-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title text-left">
                    {{ $door['name'] }}
                </h5>
                <p class="text-right">
                    <span class="text-muted small">Presença à porta: {{ $door['state'] }} <i class="bi bi-person-bounding-box"></i></span>
                </p>
                <p class="d-flex justify-content-between" title="{{ $door['auth'] ? 'Abrir' : 'Fechar' }}">
                    <span>Autorizado:</span>
                    <i class="bi bi-door-closed {{ $door['auth'] ? 'text-success' : 'text-danger' }}"></i>
                </p>
                <p class="d-flex justify-content-between">
                    <a href="/actuators/doors/{{ $door['id'] }}" class="btn btn-outline-primary btn-sm">
                        <span class="small"><i>histórico</i></span>
                    </a>
                    <a href="/actuators/doors/{{ $door['id'] }}/edit" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-gear"></i>
                    </a>
                </p>
            </div>
        </div>
    </div>
    @endforeach

</div>
@endforeach



@endsection
