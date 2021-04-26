@extends('layouts.app')

@section('content')

<div class="row mb-5">
    <div class="col-8 offset-2">
        <form action="/reset-password" method="POST">
            @csrf()
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="form-group">
                <label for="inputEmail">E-mail</label>
                <input type="email" name="email" class="form-control" id="inputEmail"
                    value="{{ old('email', $request->email) }}" required>
            </div>

            <div class="form-group">
                <label for="inputPassword">Senha</label>
                <input type="password" name="password" class="form-control" id="inputPassword" required>
            </div>

            <div class="form-group">
                <label for="inputPasswordConfirmation">Confirme a Senha</label>
                <input type="password" name="password_confirmation" class="form-control" id="inputPasswordConfirmation"
                    required>
            </div>


            <button type="submit" class="btn btn-primary">Salvar Nova Senha</button>
        </form>
    </div>
</div>

@endsection
