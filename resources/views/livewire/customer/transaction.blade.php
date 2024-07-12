@section('title', 'Transaction')

@section('head')
{{-- font --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
<link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@200;400;600&family=Newsreader:opsz,wght@6..72,200;6..72,300;6..72,400&display=swap"
    rel="stylesheet">
{{-- flowbite js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
{{-- font awesome --}}
<script src="https://kit.fontawesome.com/7eaa0f0932.js" crossorigin="anonymous"></script>
@endsection

@section('navbar')
    <livewire:customer.navbar>
@endsection

<div>
    {{-- content --}}
    <section class="mt-12 -mb-24 bg-white dark:bg-gray-900">
        <div class="px-10 py-16 mx-auto">
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
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">My Transaction</h2>
            <div class="grid gap-5">
            @foreach ($data as $item)
            <div class="flex gap-8 border-2 border-gray-100 rounded-md ">
            @foreach ($collection as $i => $image)
                @if ($image->id_booking === $item->id)
                <div class="grid w-full shadow">
                    <div class="flex items-center justify-between py-3 mx-5 border-b-2">
                        <p class="flex items-center text-lg font-bold">{{$image->service_name}}<span class="px-3 py-1 text-xs font-bold text-yellow-800 rounded-full ms-3 bg-yellow-500/50">{{$item->booking_status}}</p>
                        <div class="">
                            <button id="dropdownButton{{$item->id}}" data-dropdown-toggle="dropdown{{$item->id}}" data-dropdown-placement="left-start" type="button" class="inline-flex items-center justify-center w-10 h-10 p-2 text-sm bg-green-100 rounded-full hover:bg-green-100/50 focus:outline-none focus:ring-0 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-hamburger" aria-expanded="false">
                                <svg class="w-5 h-5 text-green-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path fill="currentColor" d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z"/></svg>
                            </button>
                            <div id="dropdown{{$item->id}}" class="hidden bg-white border-2 border-gray-100 divide-y divide-gray-100 rounded">
                                <ul class="z-10 flex flex-col gap-2 m-2 font-medium rounded-lg dark:bg-gray-800 dark:border-gray-700" aria-labelledby="dropdownButton{{$item->id}}">
                                    <li>
                                        <a href="#" class="flex gap-2 px-3 py-2 text-gray-900 rounded hover:bg-green-50 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                            <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m11.5 11.5 2.071 1.994M4 10h5m11 0h-1.5M12 7V4M7 7V4m10 3V4m-7 13H8v-2l5.227-5.292a1.46 1.46 0 0 1 2.065 2.065L10 17Zm-5 3h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z"/>
                                            </svg>
                                            <span class="text-sm">
                                                Reschedule
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="flex gap-2 px-3 py-2 text-gray-900 rounded hover:bg-green-50 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                            <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                                            </svg>
                                            <span class="text-sm">
                                                Request Cancellation
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="flex w-full gap-5 p-3">

                        <img src="{{asset('storage/img/service/'.$image->imgdir)}}" alt="" class="h-20 m-2 rounded-sm sm:h-28 md:h-32">  
                        <div class="grid items-center self-center flex-grow gap-2 my-3">
                            <p class="font-semibold">Date : <span class="font-normal">{{date_format(new DateTime($item->date), "l, j F Y")}}</span> </p>
                            <p class="font-semibold">Time : <span class="font-normal">{{date_format(new DateTime($item->date), "h:i A")}}</span> </p>
                            <p class="font-semibold">Payment Status : 
                                @if ($item->payment_status === 'PAID')
                                    <span class="px-3 py-1 text-xs font-bold text-green-800 rounded-full bg-green-500/50 ">{{$item->payment_status}}</span>
                                @elseif ($item->payment_status === 'PENDING')
                                    <span class="px-3 py-1 text-xs font-bold text-yellow-800 rounded-full bg-yellow-500/50 ">{{$item->payment_status}}</span>
                                @else
                                    <span class="px-3 py-1 text-xs font-bold text-red-800 rounded-full bg-red-500/50 ">{{$item->payment_status}}</span>
                                @endif
                            </p>
                        </div>
                        
                    </div>
                    <div class="flex justify-between mx-5 mb-3">
                        <p class="text-lg font-semibold">Total : <span class="font-normal">Rp {{number_format($item->total, '0', '.', '.')}}</span></p>
                        <div>
                            @if ($item->payment_status === 'PENDING')
                                <button class="px-5 py-2 text-xs font-semibold text-white bg-green-700 rounded hover:bg-green-800">Pay Now</button>
                            @elseif ($item->booking_status === 'COMPLETED')
                                <button class="px-5 py-2 text-xs font-semibold text-white bg-green-700 rounded hover:bg-green-800">Write Review</button>
                            @else
                                <button class="px-5 py-2 text-xs font-semibold text-white rounded bg-green-700/75 hover:cursor-not-allowed" disabled>Write Review</button>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
            </div>
            @endforeach
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
                        cancel this service?
                    </h3>
                    <p></p>
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
</div>

@push('scripts')
<script src="{{asset('js/auth/auth_popup.js')}}"></script>
@endpush