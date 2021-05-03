@extends('layouts.app')

@section('header')
@endsection

@section('content')
<div class="row mb-5">
    <div class="col">
        <div class="w3-container w3-center w3-animate-top">
            <h1 class="text-center">Smart Home</h1>
        </div>
        @auth
        @else
            <div class="w3-container w3-center w3-animate-left">
                <a href="{{ route('login') }}" class="btn btn-outline-primary">Log in</a>
            </div>
        @endauth
    </div>
</div>

<div class="row d-flex justify-content-center">
    <div class="col-6">
        <div class="w3-container w3-center w3-animate-bottom">
            <img id="smart-home-welcome" src="/imgs/smart-home.png" alt="Casa Inteligente">
        </div>
        {{--<img class="img-fluid" src="/imgs/home-img.jpg" alt="Casa com ícones dos sensores">
         <div id="home" class="home">
            <div class="orbit">
                <i id="icon-home" class="bi bi-house-door"></i>
                <i id="icon-humidity" class="bi bi-moisture"></i>
                <i id="icon-temperature" class="bi bi-thermometer-half"></i>
                <i id="icon-light" class="bi bi-thermometer-sun"></i>
                <i id="icon-motion" class="bi bi-broadcast"></i>
                <i id="icon-smoke" class="fas fa-smog"></i>
            </div>
        </div> --}}
    </div>
</div>
@endsection()
