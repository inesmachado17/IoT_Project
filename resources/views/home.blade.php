@extends('layouts.app')

@section('header')
@endsection

@section('content')
<div class="row mb-5">
    <div class="col">
        <h1 class="text-center">Smart Home</h1>
        @auth
        @else
        <a href="{{ route('login') }}" class="btn btn-outline-primary">Log in</a>
        @endauth
    </div>
</div>

<div class="row">
    <div class="col">
        <div id="home" class="home">
            {{-- <img src="/imgs/home.png" alt="Casa"> --}}
            <i id="icon-home" class="bi bi-house-door"></i>
            <i id="icon-humidity" class="bi bi-moisture"></i>
            <i id="icon-temperature" class="bi bi-thermometer-half"></i>
            <i id="icon-light" class="bi bi-thermometer-sun"></i>
            <i id="icon-motion" class="bi bi-broadcast"></i>
            <i id="icon-smoke" class="fas fa-smog"></i>
        </div>
    </div>
</div>
@endsection()
