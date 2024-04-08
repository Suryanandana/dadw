<div>
    {{-- button next --}}
    <button 
        x-show="currentStep<3"
        x-on:click="$wire.next ? currentStep++ : '', $wire.next = false"
        x-bind:class="$wire.next ? '' : 'opacity-70 cursor-not-allowed'"
        class="inline-flex px-8 py-3 mt-5 text-xs tracking-widest text-white bg-green-700 border-0 rounded-sm focus:outline-none hover:bg-green-800">
        Next
    </button>
    {{-- button submit --}}
    <button 
        x-cloak
        x-show="currentStep===3"
        wire:click="$dispatch('submit-form')"
        class="inline-flex px-8 py-3 mt-5 text-xs tracking-widest text-white bg-green-700 border-0 rounded-sm focus:outline-none hover:bg-green-800">
        Submit
    </button>
</div>