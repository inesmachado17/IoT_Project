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
                <label for="state" class="form-label" style="display: block;">Ligar/Desligar</label>
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
<script type="text/javascript">
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
    '<i class="bi bi-toggle-on text-success" title="Ligar"></i>' :
    '<i class="bi bi-toggle-off text-danger" title="Desligar"></i>';

    function toggleState() {
        inputElementState.value = inputElementState.value == '0' ? 1 : 0;
        buttonElement.innerHTML = inputElementState.value === '1' ?
        '<i class="bi bi-toggle-on text-success" title="Ligar"></i>' :
        '<i class="bi bi-toggle-off text-danger" title="Desligar"></i>';
    }
</script>
@endsection
