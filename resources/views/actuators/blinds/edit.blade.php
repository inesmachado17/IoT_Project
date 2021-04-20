@extends('layouts.app')

@section('content')
<div class="row d-flex justify-content-center">
    <div>
        <form>
            <div class="mb-3">
                <label for="name" class="form-label">Designação</label>
                <input type="text" class="form-control" id="name" name="name" value={{ $blind->name }}>
            </div>

            <div class="mb-3 form-check">
                <label for="abertura" class="form-label">Abertura</label>
                <input type="range" min="0" max="100" class="form-range" id="abertura" name="state"
                    value={{ $blind->state }}>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>

        </form>
    </div>
</div>
@endsection()
