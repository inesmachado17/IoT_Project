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
                    <input type="range" min="0" max="100" class="form-range" id="luminosidade" name="state"
                        value="{{ $lamp->state }}">
                    <span id="span-value" class="ml-2"></span>
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

    const inputElement = document.getElementById('luminosidade');

    inputElement.addEventListener('change', (event) => {
        spanElement.innerHTML = event.target.value + " %";
    })
</script>
@endsection
