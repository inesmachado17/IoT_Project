@extends('layouts.app')

@section('content')
<div class="row d-flex justify-content-center align-items-center">
    <div>
        <form action="/actuators/lamps/{{ $lamp->id }}" method="POST">
            @csrf()
            @method('PUT')
            <input type="hidden" name="return_to" value="{{ $returnUrl }}">
            <div class="mb-3">
                <label for="name" class="form-label">Designação</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $lamp->name }}">
            </div>

            <div class="mb-3">
                <label for="luminosidade" class="form-label" style="display: block;">Luminosidade</label>
                <div class="d-flex align-items-center justify-content-between">
                    <input type="range" min="0" max="100" class="form-range" id="luminosidade" name="setting"
                        value="{{ $lamp->setting }}">
                    <span id="span-value" class="ml-2"></span>
                </div>
            </div>

            <div class="mb-3">
                <span id="span-switch-op" class="form-label" style="display: block;">{{ $lamp->automatic ? 'Automático' : 'Manual' }}</span>
                <div class="d-flex align-items-center justify-content-center">
                    <button id="button-switch-op" type="button" onclick="toggleOperationMode()" class="text-secondary"></button>
                    <input type="hidden" id="automatic" name="automatic" value="{{ $lamp->automatic }}">
                </div>
            </div>

            <div class="mb-3">
                <span class="form-label" style="display: block;">Ligar/Desligar</span>
                <div class="d-flex align-items-center justify-content-center">
                    <button id="button-switch" type="button" onclick="toggleState()"></button>
                    <input type="hidden" id="state" name="state" value="{{ $lamp->state }}">
                </div>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a class="btn btn-outline-secondary" href="/actuators/lamps" role="button">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection()

@section('scripts')
<script>
    const value = {!! json_encode($lamp->setting) !!}; //"50"
    const spanElement = document.getElementById('span-value');
    spanElement.innerHTML = value + " %";

    const inputElementSetting = document.getElementById('luminosidade');

    inputElementSetting.addEventListener('change', (event) => {
        spanElement.innerHTML = event.target.value + " %";
    });


    const inputElementState = document.getElementById('state');
    const buttonElement = document.getElementById('button-switch');
    buttonElement.innerHTML = inputElementState.value === '1' ?
    '<i class="bi bi-toggle-on text-success" title="Desligar"></i>' :
    '<i class="bi bi-toggle-off text-danger" title="Ligar"></i>';

    function toggleState() {
        inputElementState.value = inputElementState.value == '0' ? 1 : 0;
        buttonElement.innerHTML = inputElementState.value === '1' ?
        '<i class="bi bi-toggle-on text-success" title="Desligar"></i>' :
        '<i class="bi bi-toggle-off text-danger" title="Ligar"></i>';
    }


    const spanOpElement = document.getElementById('span-switch-op');
    const inputOpElement = document.getElementById('automatic');
    const buttonOpElement = document.getElementById('button-switch-op');

    buttonOpElement.innerHTML = inputElementState.value === '1' ?
    '<i class="bi bi-stop-circle" title="Passar a modo Manual"></i>' :
    '<i class="bi bi-play-circle" title="Passar a modo Automático"></i>';

    buttonElement.disabled = inputOpElement.value === '1';

    function toggleOperationMode() {
        inputOpElement.value = inputOpElement.value == '0' ? 1 : 0;
        buttonOpElement.innerHTML = inputOpElement.value === '1' ?
        '<i class="bi bi-stop-circle" title="Passar a modo Manual"></i>' :
        '<i class="bi bi-play-circle" title="Passar a modo Automático"></i>';
        spanOpElement.innerHTML = inputOpElement.value === '1' ? 'Automático' : 'Manual';
        buttonElement.disabled = inputOpElement.value === '1';
    }
</script>
@endsection
