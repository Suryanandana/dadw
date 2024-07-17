<section x-cloak class="relative grid grid-cols-1 gap-3 p-5 bg-gray-100 rounded xl:col-span-2" x-show="currentStep === 3 && $wire.complete === true"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90">
    <div class="flex flex-col items-center justify-center pt-5 pb-10 bg-white px-14">
        <img class="w-1/2" src="/storage/img/payment/verify-email.png" alt="verification email image illustration">
        <div x-show="!$wire.verified">
            <h1 class="text-3xl font-bold text-center">Please verify your email</h1>
            <p class="mt-2 text-center">
                Before proceeding to the payment and checkout process, please verify your email address. A verification link has been sent to the email address you provided.
            </p>
        </div>
        <div x-show="$wire.verified">
            <h1 class="text-3xl font-bold text-center">
                Your email has been verified
            </h1>
            <p class="mt-2 text-center">
                You can now proceed to the payment and checkout process.
            </p>
        </div>
    </div>
</section>
