@extends('layouts.app')

@section('content')
<div class="row d-flex justify-content-center align-items-center">
    <div>
        <form action="/actuators/blinds/{{ $blind->id }}" method="POST">
            @csrf()
            @method('PUT')
            <input type="hidden" name="return_to" value="{{ $returnUrl }}">
            <div class="mb-3">
                <label for="name" class="form-label">Designação</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $blind->name }}">
            </div>

            <div class="mb-3">
                <span class="form-label" style="display: block;">Abertura Programada</span>
                <div class="d-flex align-items-center justify-content-between">
                    <input type="range" min="0" max="100" class="form-range" id="abertura" name="setting"
                        value="{{ $blind->setting }}">
                    <span id="span-value" class="ml-2"></span>
                </div>
            </div>
            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a class="btn btn-outline-secondary" href="/actuators/blinds" role="button">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection()

@section('scripts')
<script>
    const value = {!! json_encode($blind->setting) !!}; //"50"
    const spanElement = document.getElementById('span-value');
    spanElement.innerHTML = value + " %";

    const inputElement = document.getElementById('abertura');

    inputElement.addEventListener('change', (event) => {
        spanElement.innerHTML = event.target.value + " %";
    })
</script>
@endsection
