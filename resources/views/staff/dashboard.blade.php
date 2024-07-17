<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to The Cajuput Spa</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    {{-- font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@200;400;600&family=Newsreader:opsz,wght@6..72,200;6..72,300;6..72,400&display=swap"
        rel="stylesheet">
    {{-- alpinejs --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {{-- font awesome --}}
    <script src="https://kit.fontawesome.com/7eaa0f0932.js" crossorigin="anonymous"></script>
    {{-- splide --}}
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body>

    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        {{-- navbar --}}
        @extends('staff.navbar')

        {{-- sidebar --}}
        @extends('staff.sidebar')

        {{-- content --}}
        <main class="h-auto p-1 pt-20 md:ml-64">
            <!-- Start block -->
            <section class="p-3 antialiased bg-gray-50 dark:bg-gray-900 sm:p-5">
                <div class="max-w-screen-xl px-4 mx-auto lg:px-12">
                    <!-- Start coding here -->
                    <div class="w-1/2 mx-auto">
                        <h1 class="text-2xl font-semibold text-center">Chart Status Booking</h1>
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['BOOKING CONFIRMED', 'PAYMENT CONFIRMED', 'RESCHEDULED', 'IN PROGRESS', 'TREATMENT COMPLETED', 'CANCELLED', 'BOOKING EXPIRED'],
                datasets: [{
                    label: 'Total transaction',
                    data: [
                        {{$status['BOOKING CONFIRMED']}},
                        {{$status['PAYMENT CONFIRMED']}},
                        {{$status['RESCHEDULED']}},
                        {{$status['IN PROGRESS']}},
                        {{$status['TREATMENT COMPLETED']}},
                        {{$status['CANCELLED']}},
                        {{$status['BOOKING EXPIRED']}}
                    ],
                    backgroundColor: [
                        'yellow',
                        'green',
                        'blue',
                        'red',
                        'teal',
                        'gray',
                        'orange'
                    ],
                    hoverOffset: 4
                }]
            },
        });
    </script>
</body>

</html>