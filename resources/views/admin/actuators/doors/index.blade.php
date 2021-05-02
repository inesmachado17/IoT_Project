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
                    <span class="text-muted small">Presença à porta: {{ count($door['history']) }} <i
                            class="bi bi-person-bounding-box"></i></span>
                </p>
                <p class="text-right">
                    <span class="text-muted small">
                        Porta: <i
                            class="bi bi-door-{{ $door['state'] ? 'open text-success' : 'closed text-danger' }}"></i></span>
                </p>
                <p class="d-flex justify-content-between" title="{{ $door['locked'] ? 'Abrir' : 'Fechar' }}">
                    <span>Tranca eletrônica:</span>
                    <i class="bi bi-{{ $door['locked'] ? 'lock' : 'unlock' }}"></i>
                </p>
                <p class="d-flex justify-content-between">
                    <a href="/actuators/doors/{{ $door['id'] }}" class="btn btn-outline-primary btn-sm">
                        <span class="small"><i>histórico</i></span>
                    </a>
                    @if (Auth::user()->role === 'admin')
                    <a href="/actuators/doors/{{ $door['id'] }}/edit" class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-gear"></i>
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
