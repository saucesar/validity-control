<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ env('APP_URL') }}/bootstrap-4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ env('APP_URL') }}/css/app.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
          integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    @stack('head_scripts')

    <title>{{ $title ?? 'VC' }}</title>
</head>
<body class="{{ $bodyclass ?? '' }}">
    @if(!isset($navoff))
        @include('layouts.navbar')
    @endif
    @yield('content')

    <script src="{{ env('APP_URL') }}/js/jquery-3.5.1.min.js" type="text/javascript"></script>
    <script src="{{ env('APP_URL') }}/bootstrap-4.5.2/js/util.js" type="text/javascript"></script>
    <script src="{{ env('APP_URL') }}/bootstrap-4.5.2/js/bootstrap.min.js" type="text/javascript"></script>

    @stack('scripts')
</body>
</html>