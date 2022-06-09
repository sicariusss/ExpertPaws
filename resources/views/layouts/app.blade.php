<?php

use Illuminate\Support\Facades\Request;

?>

    <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ url('favicon.ico') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {!! SEOMeta::generate() !!}

    <!-- Scripts -->
    <script src="{{ asset('js/crm/crm.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="dns-prefetch" href="https://use.fontawesome.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/crm/crm.css') }}" rel="stylesheet">
</head>
<body>
<div>
    @include('layouts.nav')
    <main class="py-4">
        <div class="container">
            @if(Breadcrumbs::exists() && Request::path() !== 'crm')
                {{ Breadcrumbs::render() }}
            @endif
            @yield('content')
        </div>
    </main>
</div>
</body>
</html>
