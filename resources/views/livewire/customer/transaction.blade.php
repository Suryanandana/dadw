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
<livewire:payment-user.navbar>
    @endsection

    <div x-data="{
            review : false,
            sure : false,
            service : '',
            title : 'Important',
            subtitle : 'You only can reschedule once every transaction, once you agree you cannot cancel your transaction',
            sureurl : ''
        }">
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
                            <div class="flex items-center justify-between gap-3 py-3 mx-5 border-b-2">
                                <div class="flex gap-3">
                                    <span class="text-lg font-bold">{{$image->service_name}}</span>
                                    <span x-data="{status: '{{$item->booking_status}}'}" :class="{
                                        'text-blue-800 bg-blue-500/50': status !== 'TRANSACTION COMPLETE' && status !== 'BOOKING EXPIRED' && status !== 'CANCELLED', 
                                        'text-green-800 bg-green-500/50': status === 'TRANSACTION COMPLETE', 
                                        'text-red-800 bg-red-500/50': status === 'BOOKING EXPIRED' || status === 'CANCELLED', 
                                        }" class="self-center px-2 py-1 overflow-hidden text-xs font-bold rounded-sm text text-clip">
                                        {{$item->booking_status}}
                                    </span>
                                </div>
                                <div x-data="{dropdownButton{{$item->id}} : false}">
                                    <button x-on:click="dropdownButton{{$item->id}} = ! dropdownButton{{$item->id}}"
                                        class="inline-flex items-center justify-center w-10 h-10 p-2 text-sm bg-green-100 rounded-full hover:bg-green-100/50 focus:outline-none focus:ring-0 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                                        <svg class="w-5 h-5 text-green-700" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 128 512">
                                            <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path fill="currentColor"
                                                d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z" />
                                        </svg>
                                    </button>
                                    <div x-show ="dropdownButton{{$item->id}}" x-cloak
                                        class="absolute mt-2 bg-white border-2 border-gray-100 divide-y divide-gray-100 rounded right-12">
                                        <ul class="z-10 flex flex-col gap-2 m-2 font-medium rounded-lg dark:bg-gray-800 dark:border-gray-700">
                                            @if($item->payment_status === 'PENDING')
                                            <li>
                                                <button x-on:click="[
                                                    sure = true,
                                                    title = 'Cancel Booking?',
                                                    subtitle = 'Are you sure you want to cancel this booking? The date will be available for other customers',
                                                    sureurl = '/api/xendit/cancel/{{$item->external_id}}'
                                                    ]"
                                                    class="flex gap-2 px-3 py-2 text-gray-900 rounded hover:bg-green-50 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                                    <svg class="w-5 h-5 text-gray-800 dark:text-white"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M6 18 17.94 6M18 18 6.06 6" />
                                                    </svg>
                                                    <span class="text-sm">
                                                        Cancel Order
                                                    </span>
                                                </button>
                                            </li>
                                            @else
                                            <li>
                                                <a href="#"
                                                    class="flex gap-2 px-3 py-2 text-gray-900 rounded hover:bg-green-50 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                                    <svg class="w-5 h-5 text-gray-800 dark:text-white"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m11.5 11.5 2.071 1.994M4 10h5m11 0h-1.5M12 7V4M7 7V4m10 3V4m-7 13H8v-2l5.227-5.292a1.46 1.46 0 0 1 2.065 2.065L10 17Zm-5 3h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                                                    </svg>
                                                    <span class="text-sm">
                                                        Reschedule
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#"
                                                    class="flex gap-2 px-3 py-2 text-gray-900 rounded hover:bg-green-50 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                                    <svg class="w-5 h-5 text-gray-800 dark:text-white"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M6 18 17.94 6M18 18 6.06 6" />
                                                    </svg>
                                                    <span class="text-sm">
                                                        Request Cancellation
                                                    </span>
                                                </a>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            {{-- transaction data --}}
                            <div class="flex w-full p-3 sm:gap-5 sm:flex-row">
                                <div>
                                    <img src="{{asset('storage/img/service/'.$image->imgdir)}}" alt=""
                                        class="h-16 m-2 rounded-sm sm:h-28 md:h-32">
                                </div>
                                <div class="grid items-center self-center flex-grow gap-2 m-2">
                                    <div class="flex gap-2 text-sm font-semibold sm:text-base">
                                        <span class="hidden sm:block">Date : </span>
                                        <span class="font-normal">{{date_format(new DateTime($item->date), "l, j F Y")}}</span> 
                                    </div>
                                    <div class="flex gap-2 text-sm font-semibold sm:text-base">
                                        <span class="hidden sm:block">Time : </span>
                                        <span class="font-normal">{{date_format(new DateTime($item->date), "h:i A")}}</span> 
                                    </div>
                                    <div class="flex gap-2 text-sm font-semibold sm:text-base">
                                        <span class="hidden sm:block">Room : </span>
                                        <span class="font-normal">{{$item->room_name}}</span> 
                                    </div>
                                    <div class="flex gap-2 text-sm font-semibold sm:text-base">
                                        <span class="hidden sm:block">Payment Status : </span>
                                        <span x-data="{payment_status: '{{$item->payment_status}}'}" :class="{
                                            'text-green-800 rounded-sm bg-green-500/50': payment_status === 'PAID',
                                            'text-yellow-800 rounded-sm bg-yellow-500/50': payment_status === 'PENDING',
                                            'text-red-800 rounded-sm bg-red-500/50': payment_status === 'EXPIRED'}"
                                            class="px-2 py-1 text-xs font-bold text-nowrap">{{$item->payment_status}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-between mx-5 mb-3">
                                <div class="items-center gap-5 text-lg font-semibold ">
                                    <span>Total</span>
                                    <div class="text-nowrap">
                                        <span class="text-xs">Rp {{number_format($item->total/$item->pax, 0, ',', '.')}}</span>
                                        <span class="text-xs normal-case">x {{$item->pax}} Person</span><br>
                                        <span class="text-base">Rp {{number_format($item->total, 0, ',', '.')}}</span>
                                    </div>
                                </div>
                                <div class="flex">
                                    @if ($item->payment_status === 'PENDING')
                                    <button onclick="openPopup('{{$item->payment_url}}', '{{$item->external_id}}')"
                                        class="self-end px-5 py-2 text-xs tracking-wider text-white bg-green-700 rounded-sm text-nowrap hover:bg-green-800">Pay Now</button>
                                    @elseif ($item->booking_status === 'TRANSACTION COMPLETE')
                                    <button x-on:click="review = ! review; service = '{{$image->service_name}}'" x-on:click="sureurl = '/review/{{$item->external_id}}'"
                                        class="self-end px-5 py-2 text-xs tracking-wider text-white bg-green-700 rounded-sm text-nowrap hover:bg-green-800">Write Review</button>
                                    @else
                                    <button 
                                        class="self-end px-5 py-2 text-xs tracking-wider text-white rounded-sm text-nowrap bg-green-700/75 hover:cursor-not-allowed"
                                        disabled>Repeat Order</button>
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
        
        {{-- Review Modal --}}
        <div x-show="review" x-cloak x-transition.1000ms aria-hidden="true"
            class="flex overflow-y-auto overflow-x-hidden backdrop-brightness-95 backdrop-blur-sm fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-screen">
            <div class="relative w-full max-w-xl max-h-full">
                {{-- Modal content --}}
                <div x-on:click.away="review = false" class="relative bg-white rounded-md shadow dark:bg-gray-700">
                    {{-- Modal button --}}
                    <div class="flex items-center justify-between pt-4 rounded-t pe-4 md:pt-5 dark:border-gray-600">
                        <button x-on:click="review = false" type="button"
                            class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    {{-- Modal body --}}
                    <div class="grid justify-center grid-cols-1 p-4 space-y-4 md:p-5">
                        <span class="w-full text-xl font-semibold text-center text-gray-900 dark:text-white">
                            What do you think about our 
                            <span class="text-lg font-bold" x-text="service"></span>
                            ?
                        </span>
                        <div x-data="
                    {
                        rating: 0,
                        hoverRating: 0,
                        ratings: [{'amount': 1, 'label':'Terrible'}, {'amount': 2, 'label':'Bad'}, {'amount': 3, 'label':'Okay'}, {'amount': 4, 'label':'Good'}, {'amount': 5, 'label':'Great'}],
                        rate(amount) {
                            if (this.rating == amount) {
                        this.rating = 0;
                    }
                            else this.rating = amount;
                        },
                    currentLabel() {
                        let r = this.rating;
                        if (this.hoverRating != this.rating) r = this.hoverRating;
                        let i = this.ratings.findIndex(e => e.amount == r);
                        if (i >=0) {return this.ratings[i].label;} else {return ''};     
                        }
                    }
                    " class="flex flex-col items-center justify-center m-2 mx-auto space-y-2 rounded w-72">
                            <div class="flex space-x-0">
                                <template x-for="(star, index) in ratings" :key="index">
                                    <button @click="rate(star.amount)" @mouseover="hoverRating = star.amount"
                                        @mouseleave="hoverRating = rating" aria-hidden="true" :title="star.label"
                                        class="w-12 p-1 m-0 text-gray-100 rounded-sm cursor-pointer fill-current focus:outline-none focus:shadow-outline"
                                        :class="{'text-gray-300': hoverRating >= star.amount, 'text-green-600': rating >= star.amount && hoverRating >= star.amount}">
                                        <svg class="transition duration-150 w-15 stroke-green-600"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </button>

                                </template>
                            </div>
                            <div class="p-2">
                                <template x-if="rating || hoverRating">
                                    <p x-text="currentLabel()"></p>
                                </template>
                                <template x-if="!rating && !hoverRating">
                                    <p>Please Rate!</p>
                                </template>
                            </div>

                        </div>

                        <textarea id="message" rows="4" name="text" required
                            class="block p-2.5 mx-5  text-sm text-gray-900 bg-gray-50 rounded-sm border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Write Your thoughts here..."></textarea>
                    </div>
                    {{-- Modal footer --}}
                    <div class="flex items-center justify-center gap-3 pb-4 rounded-b md:pb-8 dark:border-gray-600">
                        <button x-on:click="review = false" type="button"
                            class="px-5 py-2 text-xs font-semibold tracking-wider text-green-700 bg-white border-2 border-green-700 rounded-sm focus:outline-none hover:bg-gray-100 hover:text-green-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancel</button>
                        <a type="button" wire:click="feedback('{{$item->external_id}}')"
                            class="px-5 py-2 text-xs font-medium tracking-wider text-white bg-green-700 border-2 border-green-700 rounded-sm hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Submit</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- confirm message --}}
        <div x-show="sure" x-cloak x-transition.1000ms
            class="flex overflow-y-auto overflow-x-hidden backdrop-brightness-95 backdrop-blur-sm fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-screen">
            <div class="relative max-w-sm max-h-full">
                <div x-on:click.away="sure = false" class="grid grid-cols-1 p-5 bg-white rounded-md shadow justify-items-center dark:bg-gray-700">
                    <svg class="w-16 h-16 text-green-600 dark:text-white" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 13V8m0 8h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>                  
                    <span x-text="title" class="text-lg font-semibold tracking-wider"></span>
                    <span x-text="subtitle" class="text-sm tracking-wider text-center"></span>
                    <div class="mt-5">
                        <button x-on:click="sure = false" type="button"
                            class="px-5 py-2 text-xs font-semibold tracking-wider text-green-700 bg-white border-2 border-green-700 rounded-sm focus:outline-none hover:bg-gray-100 hover:text-green-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancel</button>
                        <a type="button" x-bind:href="sureurl" wire:navigate
                            class="px-5 py-2 text-xs font-medium tracking-wider text-white bg-green-700 border-2 border-green-700 rounded-sm hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Continue</a>
                    </div>
                </div>
            </div> 
        </div>

    </div>


    @push('scripts')
    <script src="{{asset('js/auth/auth_popup.js')}}"></script>
    @endpush