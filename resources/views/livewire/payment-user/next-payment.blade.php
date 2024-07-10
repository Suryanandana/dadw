<div>
    {{-- button back --}}
    <button 
        x-on:click="currentStep > 1 ? (currentStep--, $wire.complete = false) : ''"
        x-bind:class="currenStep > 1 ? '' : 'opacity-70 cursor-not-allowed'"
        class="inline-flex px-8 py-3 mt-5 text-xs tracking-widest text-white bg-red-700 border-0 rounded-sm focus:outline-none hover:bg-red-800">
        Back
    </button>
    {{-- button next --}}
    <button 
        x-show="currentStep<3 || $wire.complete === true && (currentStep !== 4)"
        x-on:click="$wire.next ? currentStep++ : '', $wire.next = false"
        x-bind:class="$wire.next ? '' : 'opacity-70 cursor-not-allowed'"
        class="inline-flex px-8 py-3 mt-5 text-xs tracking-widest text-white bg-green-700 border-0 rounded-sm focus:outline-none hover:bg-green-800">
        Next
    </button>
    {{-- button submit --}}
    <button
        x-cloak
        x-show="currentStep===3 && $wire.complete === false"
        wire:click="$dispatch('submit-form'), $dispatch('refreshNavbar')"
        class="inline-flex px-8 py-3 mt-5 text-xs tracking-widest text-white bg-green-700 border-0 rounded-sm focus:outline-none hover:bg-green-800">
            Submit
        </span>
    </button>
    {{-- href --}}
    <a href="/transaction"
        x-bind:class="$wire.payment ? '' : 'opacity-70 cursor-not-allowed'"
        x-show="currentStep === 4"
        class="inline-flex px-8 py-3 mt-5 text-xs tracking-widest text-white bg-green-700 border-0 rounded-sm focus:outline-none hover:bg-green-800">
        Detail order
    </a>
</div>