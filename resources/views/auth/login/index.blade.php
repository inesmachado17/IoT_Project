@extends('layouts.app')

@section('content')

<div class="row mb-5">
    <div class="col-8 offset-2">
        <form action="/login" method="POST">
            @csrf()
            <div class="form-group">
                <label for="inputEmail">E-mail</label>
                <input type="email" name="email" class="form-control" id="inputEmail">
            </div>

            <div class="form-group">
                <label for="inputPassword">Senha</label>
                <input type="password" name="password" class="form-control" id="inputPassword">
            </div>

            <div class="form-group">
                <label for="inputRemember">Lembrar-me</label>
                <input type="checkbox" name="remember" class="form-control" id="inputRemember">
            </div>

            @if (Route::has('password.request'))
            <div class="form-group">
                <a class="" href="{{ route('password.request') }}">
                    Solicitar uma nova Senha!
                </a>
            </div>
            @endif

            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
    </div>
</div>

@endsection
