<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    {!! SEOMeta::generate() !!}
    <link href="{{ mix('css/site/app.css') }}" type="text/css" rel="stylesheet"/>
</head>
<body>
@if (Auth::check())
    <script>
        window.Laravel = {!!json_encode([ 'authenticated' => true, 'user' => Auth::user(), ])!!};
        console.log(window.Laravel)

    </script>
@else
    <script>
        window.Laravel = {!!json_encode([ 'authenticated' => false ])!!};
        console.log(window.Laravel)
    </script>
@endif
<div id="app">
</div>
<script src="{{ mix('js/site/app.js') }}" type="text/javascript"></script>
</body>
</html>
