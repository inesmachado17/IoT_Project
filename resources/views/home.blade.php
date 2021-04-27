@extends('layouts.app')

@section('header')
@endsection

@section('content')
<div class="row">
    <div class="col">
    <p>Apresentação do produto</p>
@auth
@else
    <a href="{{ route('login') }}" class="btn btn-outline-primary">Log in</a>
@endauth
    </div>
</div>
@endsection()
