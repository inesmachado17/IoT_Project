@extends('layouts.app')

@section('content')

<div class="row mb-5">
    <div class="col-8 offset-2">
        <form action="/forgot-password" method="POST">
            @csrf()
            <div class="form-group">
                <label for="inputEmail">E-mail</label>
                <input type="email" name="email" class="form-control" id="inputEmail">
            </div>

            <button type="submit" class="btn btn-primary">Enviar link para o E-mail</button>
        </form>
    </div>
</div>

@endsection
