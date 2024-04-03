<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/air-datepicker@3.5.0/air-datepicker.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@200;400;600&family=Newsreader:opsz,wght@6..72,200;6..72,300;6..72,400&display=swap"
        rel="stylesheet">
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/air-datepicker@3.5.0/air-datepicker.min.css">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    @extends('customer.navbar')

    <livewire:PaymentUser.payment>
    
    @extends('landing.footer')
</body>
</html>