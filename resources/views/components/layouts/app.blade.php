<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="/img/favicon/cajuput.ico">
    <title>@yield('title', 'The Cajuput Spa')</title>
    @yield('head')
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body>
    @yield('navbar')
    {{ $slot }}
    @stack('scripts')
</body>

</html>