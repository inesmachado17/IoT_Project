@extends('layouts.app')

@section('content')
<div class="row d-flex justify-content-center align-items-center">
    <div>
        <form action="/actuators/sprinklers/{{ $sprinkler->id }}" method="POST">
            @csrf()
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Designação</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $sprinkler->name }}">
            </div>

            <div class="mb-3">
                <label for="timer" class="form-label" style="display: block;">Humidade (min %)</label>
                <div class="d-flex align-items-center justify-content-between">
                    <input type="text" class="form-control" id="timer" name="timer"
                        value="{{ $sprinkler->setting }}">
                </div>
            </div>

            <div class="mb-3">
                <span id="span-switch-op" class="form-label" style="display: block;">{{ $sprinkler->automatic ? 'Automático' : 'Manual' }}</span>
                <div class="d-flex align-items-center justify-content-center">
                    <button id="button-switch-op" type="button" onclick="toggleOperationMode()" class="text-secondary"></button>
                    <input type="hidden" id="automatic" name="automatic" value="{{ $sprinkler->automatic }}">
                </div>
            </div>

            <div class="mb-3">
                <span class="form-label" style="display: block;">Ligar/Desligar</span>
                <div class="d-flex align-items-center justify-content-center">
                    <button id="button-switch" type="button" onclick="toggleState()"></button>
                    <input type="hidden" id="state" name="state" value="{{ $sprinkler->state }}">
                </div>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a class="btn btn-outline-secondary" href="/actuators/sprinklers" role="button">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection()

@section('scripts')
<script>
    const spanOpElement = document.getElementById('span-switch-op');
    const inputElement = document.getElementById('state');
    const inputOpElement = document.getElementById('automatic');
    const buttonElement = document.getElementById('button-switch');
    const buttonOpElement = document.getElementById('button-switch-op');

    buttonElement.innerHTML = inputElement.value === '1' ?
    '<i class="bi bi-toggle-on text-success" title="Desligar"></i>' :
    '<i class="bi bi-toggle-off text-danger" title="Ligar"></i>';

    buttonOpElement.innerHTML = inputElement.value === '1' ?
    '<i class="bi bi-stop-circle" title="Passar a modo Manual"></i>' :
    '<i class="bi bi-play-circle" title="Passar a modo Automático"></i>';

    buttonElement.disabled = inputOpElement.value === '1';

    function toggleState() {
        inputElement.value = inputElement.value == '0' ? 1 : 0;
        buttonElement.innerHTML = inputElement.value === '1' ?
        '<i class="bi bi-toggle-on text-success" title="Desligar"></i>' :
        '<i class="bi bi-toggle-off text-danger" title="Ligar"></i>';
    }

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
