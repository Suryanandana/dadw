<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'The Cajuput')</title>
        @yield('head')
        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body>
        @yield('navbar')
        {{ $slot }}
    </body>
</html>
