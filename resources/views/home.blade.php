@extends('layouts.app')

@section('header')

@if (Route::has('login'))
<div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
    @auth
    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
    @else
    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>
    @endauth
</div>
@endif

@endsection

@section('content')


<p>Apresentação do produto</p>


@endsection()
