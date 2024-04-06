<section x-cloak class="grid grid-cols-1 gap-3 p-5 bg-gray-100 rounded xl:col-span-2" x-show="currentStep === 2" x-transition.duration.300ms.delay.300ms>
    <div class="w-full col-span-2 p-3 bg-white rounded-lg">
        <livewire:payment-user.date-input />
    </div>
</section>

<script class="asset{{'js/payment-user/date.js'}}"></script>