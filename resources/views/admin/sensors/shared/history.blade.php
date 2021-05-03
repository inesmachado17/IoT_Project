@extends('layouts.app')

@section('content')

<div class="row d-flex justify-content-center mb-3">
    <div class="col-6 d-flex justify-content-between">
        <a class="btn btn-outline-secondary btn-sm" href="/sensors/{{ $uriName }}/force-update" role="button"
            title="Atualizar registos">
            <i class="bi bi-arrow-repeat"></i>
        </a>
        <a class="btn btn-outline-secondary btn-sm" href="/dashboard" role="button">Voltar</a>
    </div>
</div>

<div class="row mb-3">
    <div class="col">
        <canvas id="sensorChart" height="100"></canvas>
        @section('chart-script')
        <script>
            const canvasElement = document.getElementById('sensorChart');
            const ctx = canvasElement.getContext('2d');
        </script>
        @yield('script')
        @endsection
    </div>
</div>

<div class="row d-flex justify-content-center">
    <div class="col-md-2 col-sm-1 align-self-center">
        <div class="sensor-icon-history">
            @yield('svg-icon')
        </div>
    </div>
    <div class="col-6">
        <p>Últimas leituras</p>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center">Data</th>
                    <th class="text-center">Valor lido</th>
                </tr>
            </thead>
            <tbody>
                @yield('table-tr')
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
