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
        @extends('admin.navbar')

        {{-- sidebar --}}
        @extends('admin.sidebar')

        {{-- content --}}
        <main class="p-1 md:ml-64 h-auto pt-20">
            <!-- Start block -->
            <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
                <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                    <!-- Start coding here -->
                    @if ($errors->any())
                    <div class="bg-red-500 p-4 rounded-lg mb-6 text-white text-center">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    {{-- show success message --}}
                    @if (session('success'))
                    <div class="bg-green-500 p-4 rounded-lg mb-6 text-white text-center">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                        
                        <div class="overflow-x-auto">
                        @if ($data->count() > 0)
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-4 py-4">January</th>
                                        <th scope="col" class="px-4 py-3">February</th>
                                        <th scope="col" class="px-4 py-3">March</th>
                                        <th scope="col" class="px-4 py-3">April</th>
                                        <th scope="col" class="px-4 py-3">May</th>
                                        <th scope="col" class="px-4 py-3">June</th>
                                        <th scope="col" class="px-4 py-3">July</th>
                                        <th scope="col" class="px-4 py-3">August</th>
                                        <th scope="col" class="px-4 py-3">September</th>
                                        <th scope="col" class="px-4 py-3">October</th>
                                        <th scope="col" class="px-4 py-3">November</th>
                                        <th scope="col" class="px-4 py-3">December</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b dark:border-gray-700">
                                        <td class="px-4 py-3">
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($data as $item)
                                                @if ($item->month == "01")
                                                    @php
                                                        $total += $item->price * $item->pax;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            Rp.{{ number_format($total,2,',','.')}}
                                        </td>
                                        <td class="px-4 py-3">
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($data as $item)
                                                @if ($item->month == "02")
                                                    @php
                                                        $total += $item->price * $item->pax;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            Rp.{{ number_format($total,2,',','.')}}
                                        </td>
                                        <td class="px-4 py-3">
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($data as $item)
                                                @if ($item->month == "03")
                                                    @php
                                                        $total += $item->price * $item->pax;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            Rp.{{ number_format($total,2,',','.')}}
                                        </td>
                                        <td class="px-4 py-3">
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($data as $item)
                                                @if ($item->month == "04")
                                                    @php
                                                        $total += $item->price * $item->pax;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            Rp.{{ number_format($total,2,',','.')}}
                                        </td>
                                        <td class="px-4 py-3">
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($data as $item)
                                                @if ($item->month == "05")
                                                    @php
                                                        $total += $item->price * $item->pax;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            Rp.{{ number_format($total,2,',','.')}}
                                        </td>
                                        <td class="px-4 py-3">
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($data as $item)
                                                @if ($item->month == "06")
                                                    @php
                                                        $total += $item->price * $item->pax;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            Rp.{{ number_format($total,2,',','.')}}
                                        </td>
                                        <td class="px-4 py-3">
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($data as $item)
                                                @if ($item->month == "07")
                                                    @php
                                                        $total += $item->price * $item->pax;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            Rp.{{ number_format($total,2,',','.')}}
                                        </td>
                                        <td class="px-4 py-3">
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($data as $item)
                                                @if ($item->month == "08")
                                                    @php
                                                        $total += $item->price * $item->pax;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            Rp.{{ number_format($total,2,',','.')}}
                                        </td>
                                        <td class="px-4 py-3">
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($data as $item)
                                                @if ($item->month == "09")
                                                    @php
                                                        $total += $item->price * $item->pax;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            Rp.{{ number_format($total,2,',','.')}}
                                        </td>
                                        <td class="px-4 py-3">
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($data as $item)
                                                @if ($item->month == "10")
                                                    @php
                                                        $total += $item->price * $item->pax;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            Rp.{{ number_format($total,2,',','.')}}
                                        </td>
                                        <td class="px-4 py-3">
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($data as $item)
                                                @if ($item->month == "11")
                                                    @php
                                                        $total += $item->price * $item->pax;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            Rp.{{ number_format($total,2,',','.')}}
                                        </td>
                                        <td class="px-4 py-3">
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($data as $item)
                                                @if ($item->month == "12")
                                                    @php
                                                        $total += $item->price * $item->pax;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            Rp.{{ number_format($total,2,',','.')}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            @else
                                <p class="text-gray-700 text-sm text-center py-4">Staff Account Empty !</p>
                            @endif
                        </div>
                        <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                            aria-label="Table navigation">
                            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                Showing
                                <span class="font-semibold text-gray-900 dark:text-white">1-10</span>
                                of
                                <span class="font-semibold text-gray-900 dark:text-white">1000</span>
                            </span>
                            <ul class="inline-flex items-stretch -space-x-px">
                                <li>
                                    <a href="#"
                                        class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                        <span class="sr-only">Previous</span>
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                                </li>
                                <li>
                                    <a href="#" aria-current="page"
                                        class="flex items-center justify-center text-sm z-10 py-2 px-3 leading-tight text-primary-600 bg-primary-50 border border-primary-300 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">...</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">100</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                        <span class="sr-only">Next</span>
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>

</html>