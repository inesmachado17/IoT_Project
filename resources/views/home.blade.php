@extends('layouts.app')

@section('header')
@endsection

@section('content')
<div class="row mb-5">
    <div class="col">
        <div class="w3-container w3-center w3-animate-top w3-animate-fading" style="animation-duration: 1s">
            <h1 class="text-center">Smart Home</h1>
        </div>
        @auth
        @else
            <div class="w3-container w3-center w3-animate-left w3-animate-fading" style="animation-duration: 1s">
                <a href="{{ route('login') }}" class="btn btn-outline-primary">Log in</a>
            </div>
        @endauth
    </div>
</div>

<div class="row d-flex justify-content-center">
    <div class="col-6">
        <div class="w3-container w3-center w3-animate-bottom w3-animate-fading" style="animation-duration: 1s">
            <img id="smart-home-welcome" src="/imgs/smart-home.png" alt="Casa Inteligente">
        </div>
    </div>
</div>
@endsection()
