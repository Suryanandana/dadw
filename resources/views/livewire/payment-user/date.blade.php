<section x-cloak class="relative grid grid-cols-1 gap-3 p-5 bg-gray-100 rounded xl:col-span-2" x-show="currentStep === 2"
        x-transition:enter="transition ease-out duration-300 delay-300"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90">
    <div class="w-full col-span-2 p-3 bg-white rounded-lg" x-bind:class="currentStep !== 2 ? 'absolute w-full top-5' : ''">
        <livewire:payment-user.date-input />
    </div>
</section>