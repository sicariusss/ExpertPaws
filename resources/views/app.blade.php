<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ url('favicon.ico') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link href="{{ mix('css/site/app.css') }}" type="text/css" rel="stylesheet"/>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
@if (Auth::check())
    <script>
        window.Laravel = {!!json_encode([ 'authenticated' => true, 'user' => Auth::user(), ])!!};
    </script>
@else
    <script>
        window.Laravel = {!!json_encode([ 'authenticated' => false ])!!};
    </script>
@endif
<div id="app">
</div>
<script src="{{ asset('js/site/swiper-bundle.min.js') }}" type="text/javascript"></script>
<script src="{{ mix('js/site/app.js') }}" type="text/javascript"></script>
</body>
</html>
