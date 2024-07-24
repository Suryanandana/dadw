<div x-show="$wire.show" x-cloak
    class="overflow-y-auto overflow-x-hidden cursor-not-allowed fixed bg-clip-padding backdrop-filter backdrop-blur-sm bg-opacity-10 top-0 right-0 flex left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full p-4 bg-red-200 cursor-auto" x-data={invoice:false}>
        <div class="fixed w-full max-w-md max-h-full -translate-x-1/2 -translate-y-1/2 bg-white rounded-lg shadow-xl left-1/2 top-1/2 dark:bg-gray-700" x-show="!invoice && !$wire.paid"
            x-transition:enter="transition ease-out duration-300 delay-300" x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
            <div class="p-4 text-center md:p-5">
                <svg class="w-12 h-12 mx-auto mb-4 text-gray-400 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="text-lg font-normal text-gray-900 dark:text-gray-400">You have unfinished payment</h3>
                <p class="mb-5 text-gray-500">
                    Please complete the payment before placing another order, or you can cancel this booking.
                </p>
                {{-- <div x-data="countdown('{{$expired_date}}')" class="mt-2 mb-5">
                    <p class="text-gray-700">Payment expired in:</p>
                    <p id="days" class="text-center text-gray-500"></p>
                </div> --}}
                <a data-modal-hide="popup-modal" href="/transaction" wire:navigate
                class="py-2.5 px-5 text-sm font-medium text-white focus:outline-none bg-green-700 rounded-sm border border-gray-200 hover:bg-green-800 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                View order</a>
            </div>
        </div>
        {{-- invoice --}}
        <div class="fixed w-full max-w-md max-h-full -translate-x-1/2 -translate-y-1/2 bg-white rounded-lg left-1/2 top-1/2 dark:bg-gray-700" x-show="invoice && !$wire.paid"
            x-transition:enter="transition ease-out duration-300 delay-300" x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
            <div class="p-4 text-center md:p-5">  
                <div class="relative overflow-x-auto sm:rounded-lg">
                    <table class="w-full mb-4 text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-white dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Service name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    price
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($details)                                
                            @foreach ($details as $detail)
                            <tr class="bg-white dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$detail->service_name}}
                                </th>
                                <td class="px-6 py-4">
                                    Rp {{number_format($detail->price, 0, ',', '.')}}
                                </td>
                            </tr>
                            @endforeach
                            @endisset
                        </tbody>
                        <thead class="text-xs text-gray-700 uppercase bg-white dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Total
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    @isset($booking)                                        
                                    @if ($booking->pax > 1)
                                    <span class="text-xs">Rp {{number_format($booking->total/$booking->pax, 0, ',', '.')}}</span>
                                    <span class="text-xs normal-case">x {{$booking->pax}} Person</span><br>
                                    @endif
                                    <span class="text-base">Rp {{number_format($booking->total, 0, ',', '.')}}</span>  
                                    @endisset
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
                @isset($booking)                                        
                <a href="{{$booking->payment_url}}" target="_blank"
                    class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Process payment
                </a>
                @endisset
                <button type="button" x-on:click="invoice=false"
                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Go back
                    </button>
            </div>
        </div>
        {{-- finished --}}
        <div class="fixed w-full max-w-md max-h-full -translate-x-1/2 -translate-y-1/2 bg-white rounded-lg shadow-xl left-1/2 top-1/2 dark:bg-gray-700" x-show="$wire.paid"
            x-transition:enter="transition ease-out duration-300 delay-300" x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
            <div class="p-4 text-center md:p-5">
                <svg class="w-12 h-12 mx-auto mb-4 text-green-400 dark:text-green-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="text-lg font-normal text-gray-900 dark:text-gray-400">You have finished your payment</h3>
                <p class="mt-1 mb-5 text-gray-500">
                    You have successfully completed your payment. If you want to view your order, click the button below.
                </p>
                <a href="/bookings" wire:navigate data-modal-hide="popup-modal" type="button" x-on:click="invoice=true"
                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                View order</a>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    function countdown(endDate) {
        return {
            timeRemaining: null,
            timer: null,
            init() {
                this.timer = setInterval(() => {
                    const now = new Date().getTime();
                    const distance = (new Date(endDate).getTime()) - now;
                    if (!isNaN(distance)) {
                        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                        document.getElementById("days").innerHTML = `${hours}h ${minutes}m ${seconds}s`;
                        if (distance < 0) {
                            clearInterval(this.timer);
                            this.timeRemaining = "EXPIRED";
                        }
                    }                    
                }, 1000);
            }
        }
    }
</script>
@endpush