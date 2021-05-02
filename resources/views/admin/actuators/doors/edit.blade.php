@extends('layouts.app')

@section('content')
<div class="row d-flex justify-content-center align-items-center">
    <div>
        <form action="/actuators/doors/{{ $door->id }}" method="POST">
            @csrf()
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Designação</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $door->name }}">
            </div>

            <div class="mb-3">
                <label for="timer" class="form-label" style="display: block;">Presença</label>
                <div class="d-flex align-items-center justify-content-between">
                    <input type="text" class="form-control" id="timer" name="timer"
                        value="{{ $door->state }}">
                </div>
            </div>

            <div class="mb-3">
                <label for="state" class="form-label" style="display: block;">Abrir/Fechar</label>
                <div class="d-flex align-items-center justify-content-center">
                    <button id="button-switch" type="button" onclick="toggleState()"></button>
                    <input type="hidden" id="state" name="state" value="{{ $door->auth }}">
                </div>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a class="btn btn-outline-secondary" href="/actuators/doors" role="button">Cancelar</a>
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
    '<i class="bi bi-toggle-on text-success" title="Ligar"></i>' :
    '<i class="bi bi-toggle-off text-danger" title="Desligar"></i>';

    function toggleState() {
        inputElement.value = inputElement.value == '0' ? 1 : 0;
        buttonElement.innerHTML = inputElement.value === '1' ?
        '<i class="bi bi-toggle-on text-success" title="Ligar"></i>' :
        '<i class="bi bi-toggle-off text-danger" title="Desligar"></i>';
    }
</script>
@endsection
