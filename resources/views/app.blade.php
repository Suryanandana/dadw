<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Test Tailwind</title>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.2/dist/echo.iife.js"></script>
</head>

<body>
    <livewire:Chat>

        <script>
            window.Echo = new Echo({
                broadcaster: 'pusher',
                key: "1adc1e5da12837579dc7",
                cluster: 'ap1',
                forceTLS: true
            });
        </script>
</body>

</html>