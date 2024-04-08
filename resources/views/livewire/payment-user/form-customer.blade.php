<section x-cloak class="grid grid-cols-1 gap-3 p-5 bg-gray-100 rounded xl:col-span-2" x-show="currentStep === 3"
    x-transition:enter="transition ease-out duration-300 delay-300" x-transition:enter-start="opacity-0 scale-90"
    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
    <div class="w-full col-span-2 p-3 bg-white rounded-lg">
        <form class="grid gap-4 mb-4 sm:grid-cols-2" wire:submit='validateForm'>
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                <input wire:model.live.debounce.200ms='name' type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 @error('name') {{'outline-red-400 border-red-400'}} @enderror
                " placeholder="Your Name..." required />
                <div>
                    @error('name')<span class="text-xs text-red-600">*{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <input wire:model.live.debounce.300ms='email' type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 @error('email') {{'outline-red-400 border-red-400'}} @enderror
                " placeholder="Your Email..." required />
                <div>
                    @error('email')<span class="text-xs text-red-600">*{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                <input wire:model.live.debounce.300ms='phone' type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 @error('phone') {{'outline-red-400 border-red-400'}} @enderror
                " placeholder="Your phone number..." required />
                <div>
                    @error('phone')<span class="text-xs text-red-600">*{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="relative" x-data="{country:[], open: false}">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
                <input type="text" id="country" x-ref="country" x-on:click="open = true" x-on:keyup="
                    fetchData($event.target.value).then(data => {
                    data = data.slice(0, 5);
                    country = data
                    }).catch(error => {
                    country = [];
                    }), open = true"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 @error('country') {{'outline-red-400 border-red-400'}} @enderror"
                    placeholder="Your country..." required="" wire:model.live='country'>
                <div>
                    @error('country')<span class="text-xs text-red-600">*{{ $message }}</span> @enderror
                </div>
                <div x-show="open" x-transition x-on:click.away="open = false"
                    class="absolute left-0 z-10 w-full bg-white divide-y divide-gray-100 rounded-lg shadow top-20 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button-2">
                        <template x-if="country.length === 0">
                            <li class="px-4 py-2">No results found</li>
                        </template>
                        <template x-for="c in country">
                            <li x-on:click="$wire.country = c.name.common, open = false, $wire.dispatchCountry(c.name.common),
                                fetchData(c.name.common).then(data => {
                                data = data.slice(0, 5);
                                country = data
                                }).catch(error => {
                                country = [];
                                })">
                                <button type="button"
                                    class="inline-flex w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white"
                                    role="menuitem">
                                    <div class="inline-flex items-center">
                                        <img x-bind:src="c.flags.png" class="w-5 h-5 mr-2 rounded-full" alt="" />
                                        <span x-text="c.name.common"></span>
                                    </div>
                                </button>
                            </li>
                        </template>
                    </ul>
                </div>
            </div>
            <div class="sm:col-span-2">
                <label for="description"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                <textarea id="description" rows="4" wire:model.live.debounce.300ms='address'
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 @error('address') {{'outline-red-400 border-red-400'}} @enderror"
                    placeholder="Your address..."></textarea>
                    <div>
                        @error('address')<span class="text-xs text-red-600">*{{ $message }}</span> @enderror
                    </div>
            </div>
            <label for="description" class="block -mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                Pax</label>
            <div class="grid grid-cols-3 gap-2 -mb-4 sm:col-span-2" x-data="{number: 0}">
                <div wire:click='setPax(1)' x-on:click="number = 1"
                    x-bind:class="number === 1 ? 'border-green-400 text-green-900' : 'border-gray-200 text-gray-700'"
                    class="flex flex-col items-center justify-center p-5 border-[3px] rounded-lg cursor-pointer">
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-width="2"
                            d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <span>1 Person</span>
                </div>
                <div wire:click='setPax(2)' x-on:click="number = 2"
                    x-bind:class="number === 2 ? 'border-green-400 text-green-900' : 'border-gray-200 text-gray-700'"
                    class="flex flex-col items-center justify-center p-5 border-[3px] rounded-lg cursor-pointer">
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="M16 19h4a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-2m-2.236-4a3 3 0 1 0 0-4M3 18v-1a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <span>2 Person</span>
                </div>
                <div wire:click='setPax(3)' x-on:click="number = 3"
                    x-bind:class="number === 3 ? 'border-green-400 text-green-900' : 'border-gray-200 text-gray-700'"
                    class="flex flex-col items-center justify-center p-5 border-[3px] rounded-lg cursor-pointer">
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="M4.5 17H4a1 1 0 0 1-1-1 3 3 0 0 1 3-3h1m0-3.05A2.5 2.5 0 1 1 9 5.5M19.5 17h.5a1 1 0 0 0 1-1 3 3 0 0 0-3-3h-1m0-3.05a2.5 2.5 0 1 0-2-4.45m.5 13.5h-7a1 1 0 0 1-1-1 3 3 0 0 1 3-3h3a3 3 0 0 1 3 3 1 1 0 0 1-1 1Zm-1-9.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                    </svg>
                    <span>3 Person</span>
                </div>
            </div>
            <div>
                @error('pax')<span class="text-xs text-red-600">*{{ $message }}</span> @enderror
            </div>
        </form>
    </div>
</section>