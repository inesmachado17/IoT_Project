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

            <div class="mb-3 form-check">
                <label for="abertura" class="form-label">Abertura</label>
                <input type="range" min="0" max="100" class="form-range" id="abertura" name="state"
                    value="{{ $blind->state }}">
            </div>
            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a class="btn btn-outline-secondary" href="/actuators/blinds" role="button">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection()
