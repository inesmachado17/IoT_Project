<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">

    <title>Iot - Smart Home</title>

</head>

<body class="d-flex flex-column" style="{{ isset($isHome) && $isHome ? 'overflow: hidden' : '' }}">

    <header>
        @auth
        @include('layouts.navbar')
        @endauth
        <div class="row d-flex justify-content-end m-3">

            @if (isset($fireAlarm))
            <span id="fire-alarm-icon">
                @if ($fireAlarm && $fireAlarm->state)
                <button type="button" class="btn btn-danger">Ligar 112</button>
                {{-- <button type="button" class="btn btn-outline-danger">Desligar Alarme</button> --}}
                {{-- <a class="btn btn-danger" href="#" role="button">Ligar 112</a>--}}
                <a class="btn btn-outline-danger" href="/actuators/fire-alarms/turn-off/{{$fireAlarm->id}}"
                    role="button">Desligar
                    Alarme</a>
                @endif

                <span class="text-muted ml-4 mr-2 {{ $fireAlarm && $fireAlarm->state ? '' : 'small'}}">Alarme de
                    incêndio</span>
                {!! $fireAlarm && $fireAlarm->state ? '<i class="far fa-bell text-danger on"></i>' : '<i
                    class="far fa-bell text-muted"></i>'
                !!}
            </span>
            @endif

        </div>

    </header>

    <main class="d-flex flex-column flex-grow-1 justify-content-center">
        <div class="container">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

        <div class="container">
            @yield('content')
        </div>

    </main>

    @include('layouts.footer')

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

    <!--Chart.js-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.0/dist/chart.min.js"></script>
    @yield('chart-script')

    @yield('scripts')

    @if (env('APP_EMULATE_CPT'))
    <!-- For demonstration purpose -->
    <noscript>
        You need to enable JavaScript to run this demonstration.
    </noscript>
    <div id="app-demo"></div>
    <script src={{ url('demo/app.js') }}></script>
    @endif
</body>

</html>
