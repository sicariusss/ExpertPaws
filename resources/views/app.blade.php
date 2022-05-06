<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>{{env('APP_NAME')}}</title>
    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet"/>
</head>
<body>
{{--@if (Request::url() === url('/'))--}}
{{--    <script>--}}
{{--        window.mainpage = {!!json_encode([--}}
{{--            'main' => true,--}}
{{--        ])!!}--}}
{{--    </script>--}}
{{--@else--}}
{{--    <script>--}}
{{--        window.mainpage = {!!json_encode([--}}
{{--            'main' => false,--}}
{{--        ])!!}--}}
{{--    </script>--}}
{{--@endif--}}
@if (Auth::check())
    <script>
        window.Laravel = {!!json_encode([
            'isLoggedIn' => true,
            'user' => Auth::user(),
        ])!!}
    </script>
@else
    <script>
        window.Laravel = {!!json_encode([
            'isLoggedIn' => false
        ])!!}
    </script>
@endif
<div id="app">
</div>
<script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
</body>
</html>
