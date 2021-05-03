@extends('layouts.app')

@section('content')
<div class="row d-flex justify-content-center align-items-center">
    <div>
        <form action="/actuators/air-conditioners/{{ $airConditioner->id }}" method="POST">
            @csrf()
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Designação</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $airConditioner->name }}">
            </div>

            <div class="mb-3">
                <label for="setting" class="form-label" style="display: block;">Temperatura</label>
                <div class="d-flex align-items-center justify-content-between">
                    <input type="text" class="form-control" id="setting" name="setting"
                        value="{{ $airConditioner->setting }}">
                </div>
            </div>

            <div class="mb-3">
                <label for="state" class="form-label" style="display: block;">Ligar/Desligar</label>
                <div class="d-flex align-items-center justify-content-center">
                    <button id="button-switch" type="button" onclick="toggleState()"></button>
                    <input type="hidden" id="state" name="state" value="{{ $airConditioner->state }}">
                </div>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a class="btn btn-outline-secondary" href="/actuators/air-conditioners" role="button">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection()

@section('scripts')
<script type="text/javascript">
    const inputElement = document.getElementById('state');
    const buttonElement = document.getElementById('button-switch');
    buttonElement.innerHTML = inputElement.value === '1' ?
    '<i class="bi bi-toggle-on text-success" title="Desligar"></i>' :
    '<i class="bi bi-toggle-off text-danger" title="Ligar"></i>';

    function toggleState() {
        inputElement.value = inputElement.value == '0' ? 1 : 0;
        buttonElement.innerHTML = inputElement.value === '1' ?
        '<i class="bi bi-toggle-on text-success" title="Desligar"></i>' :
        '<i class="bi bi-toggle-off text-danger" title="Ligar"></i>';
    }
</script>
@endsection
