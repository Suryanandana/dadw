<section x-cloak class="relative grid grid-cols-1 gap-3 p-5 bg-gray-100 rounded xl:col-span-2"
    x-show="currentStep === 4" x-transition:enter="transition ease-out duration-300 delay-300"
    x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-90">
    <div class="flex flex-col items-center justify-center pt-5 pb-10 bg-white px-14">
        <img class="w-1/2" src="/storage/img/payment/payment.jpg" alt="verification email image illustration">
        @if ($paid)
        <div class="flex flex-col items-center">
            <h1 class="text-3xl font-bold text-center">Payment Success</h1>
            <p class="mt-2 text-center">
                Please finalize your payment to complete your booking. You will receive a confirmation email once the
                payment has been processed.
            </p>
        </div>
        @else
        <div class="flex flex-col items-center">
            <h1 class="text-3xl font-bold text-center">Please complete your payment</h1>
            <p class="mt-2 text-center">
                Please finalize your payment to complete your booking. You will receive a confirmation email once the
                payment has been processed.
            </p>
            <div x-data="countdown('{{$expiry_date}}')" class="mt-2">
                <p>Payment expired in:</p>
                <p id="payment" class="text-center"></p>
            </div>
            <a href="{{$invoice_url}}" target="_blank" type="button"
                class="text-green-700 mt-5 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">Process
                Payment</a>
        </div>
        @endif
    </div>
</section>
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
                        document.getElementById("payment").innerHTML = `${hours}h ${minutes}m ${seconds}s`;
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