<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Billar') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href={{ asset('css/bootstrap-grid.min.css') }} rel="stylesheet">
    <link href={{ asset('css/bootstrap-grid.rtl.min.css') }} rel="stylesheet">
    <link href={{ asset('css/bootstrap-reboot.min.css') }} rel="stylesheet">
    <link href={{ asset('css/bootstrap-reboot.rtl.min.css') }} rel="stylesheet">
    <link href={{ asset('css/bootstrap-utilities.min.css') }} rel="stylesheet">
    <link href={{ asset('css/bootstrap-utilities.rtl.min.css') }} rel="stylesheet">
    <link href={{ asset('css/bootstrap.min.css') }} rel="stylesheet">
    <link href={{ asset('css/bootstrap.rtl.min.css') }} rel="stylesheet">


    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.5.1/css/all.css" crossorigin="anonymous">
    @livewireStyles
</head>

<body class="bg-success bg-opacity-25">
    @php
    $usuario_actual = Auth::user();
    @endphp

    <div class="container-fluid">
        @include('layouts.header')

        @include('layouts.sidebar')
    </div>

    <div class="container pt-5">
        <div class="row pt-5">
            <div class="col-2">

            </div>
            <div class="col-10">
                @yield('content')
            </div>
        </div>
    </div>
    @livewireScripts
</body>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.esm.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

</html>
