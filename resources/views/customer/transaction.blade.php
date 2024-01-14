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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/datepicker.min.js"></script>
    <script src="https://kit.fontawesome.com/7eaa0f0932.js" crossorigin="anonymous"></script>
</head>

<body x-data="{id:0, deleteForm: false, feedbackForm: false, date:''}">
    {{-- navbar --}}
    @extends('landing.navbar')

    {{-- content --}}
    <section class="mt-12 -mb-24 bg-white dark:bg-gray-900">
        <div class="px-10 mx-auto lg:py-16">
            {{-- show validate error --}}
            @if ($errors->any())
            <div class="p-4 mb-6 text-center text-white bg-red-500 rounded-lg">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            {{-- show success message --}}
            @if (session('success'))
            <div class="p-4 mb-6 text-center text-white bg-green-500 rounded-lg">
                {{ session('success') }}
            </div>
            @endif
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">All Transaction</h2>
            <div class="relative mb-20 overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Product
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Pax
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Room
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$loop->iteration}}
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                {{$item->service_name}}
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                {{$item->date}}
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                {{$item->pax}}
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                {{'Rp. '.number_format(num: $item->price * $item->pax, thousands_separator: '.')}}
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                {{$item->room_name}}
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="{{$item->color}} text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{$item->status_booking}}</span>
                            </td>
                            @if ($item->status_booking != 'cancelled')
                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                @if ($item->status_booking != 'reschedule' && $item->status_booking != 'complete')
                                <a href="/reschedule?id={{$item->id_booking}}"
                                    class="text-yellow-600 hover:text-yellow-900">Reschedule</a>
                                @endif
                                @if ($item->status_booking != 'complete')
                                <button class="text-red-600 cursor-pointer hover:text-red-900"
                                    x-on:click="deleteForm = true, id = {{$item->id_booking}}, date = '{{$item->date}}'">Cancel</button>
                                @endif
                                @if ($item->status_booking == 'complete' && $item->feedback == null)                                
                                <button class="text-green-600 cursor-pointer hover:text-green-900"
                                    x-on:click="feedbackForm = true, id = {{$item->id_booking}}">Feedback</button>
                                @endif
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    {{-- confirm delete --}}
    <div x-show="deleteForm" x-cloak
        class="w-full flex justify-center items-center absolute left-1/2 md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full p-4">
            <div class="relative bg-white rounded-lg shadow-lg dark:bg-gray-700">
                <button type="button" x-on:click="deleteForm = false"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 text-center md:p-5">
                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-400 dark:text-gray-200" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to
                        cancel this service?</h3>
                    <form action="/cancel" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        <input type="hidden" name="id" x-model="id">
                        <input type="hidden" name="date" x-model="date">
                        <input data-modal-hide="popup-modal" type="submit" value="Yes, I'm Sure"
                            class="text-white cursor-pointer bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                        <button data-modal-hide="popup-modal" type="button" x-on:click="deleteForm = false"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                            cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- feedback --}}
    <div x-show="feedbackForm" x-cloak
        class="w-full flex justify-center items-center absolute left-1/2 md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full p-4">
            <div class="relative bg-white rounded-lg shadow-lg dark:bg-gray-700">
                <button type="button" x-on:click="feedbackForm = false, rating = 3, text = ''"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5">
                    <form action="/feedback" method="POST" x-data="{rating: 'neutral', text: ''}">
                        @csrf
                        <p class="mb-3 text-center ">How was quality of our service?</p>
                        <div class="flex items-center justify-center gap-x-3">
                            <i class="text-4xl cursor-pointer fa-regular fa-face-frown hover:text-red-500" x-bind:class="rating == 'dislike' ? 'text-red-500' : 'text-gray-300'" x-on:click="rating = 'dislike'"></i>
                            <i class="text-4xl cursor-pointer fa-regular fa-face-meh hover:text-yellow-500" x-bind:class="rating == 'neutral' ? 'text-yellow-500' : 'text-gray-300'" x-on:click="rating = 'neutral'"></i>
                            <i class="text-4xl cursor-pointer fa-regular fa-face-smile hover:text-green-500" x-bind:class="rating == 'like' ? 'text-green-500' : 'text-gray-300'" x-on:click="rating = 'like'"></i>
                            <input type="hidden" name="rate" x-model="rating" required>
                        </div>
                        <p x-text="rating" class="mt-2 text-center" x-bind:class="rating == 'neutral' ? 'text-yellow-500' : rating == 'like' ? 'text-green-500' : 'text-red-500'"></p>
                        <input type="hidden" name="id_booking" x-model="id">
                        <label for="message" class="block mt-6 mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                            message</label>
                        <textarea id="message" rows="4" name="text" required x-model="text"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Write your thoughts here..."></textarea>
                            <div class="flex items-end justify-center">
                                <input data-modal-hide="popup-modal" type="submit" value="Rate now"
                                    class="text-white mt-5 cursor-pointer bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                <button data-modal-hide="popup-modal" type="button" x-on:click="feedbackForm = false, rating = 3, text = ''"
                                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                                    cancel</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>