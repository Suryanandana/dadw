<section x-cloak class="relative grid grid-cols-1 gap-3 p-5 bg-gray-100 rounded xl:col-span-2" x-show="currentStep === 4">
    <div class="flex flex-col items-center justify-center pt-5 pb-10 bg-white px-14">
        <img class="w-1/2" src="{{asset('img/payment/payment.jpg')}}" alt="verification email image illustration">
        <div class="flex flex-col items-center">
            <h1 class="text-3xl font-bold text-center">Please complete your payment</h1>
            <p class="mt-2 text-center">
                Please finalize your payment to complete your booking. You will receive a confirmation email once the payment has been processed.
            </p>
            <a href="{{$invoice_url}}" target="_blank" type="button" class="text-green-700 mt-5 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">Process Payment</a>
        </div>
    </div>
</section>