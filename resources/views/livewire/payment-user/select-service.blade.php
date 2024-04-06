<section class="relative bg-gray-100 rounded xl:col-span-2"
        x-show="currentStep === 1"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90">
        <div class="grid grid-cols-1 gap-3 p-5" x-bind:class="currentStep !== 1 ? 'absolute w-full' : ''">
            @foreach ($services as $service)
            <div class="w-full col-span-2 p-3 bg-white rounded-lg" x-data="{open: false}">
                <div class="flex items-center justify-between">
                    <div class="flex flex-col">
                        <span class="text-lg font-semibold">{{$service->service_name}}</span>
                        <span class="text-green-700">Rp {{number_format($service->price, 0, ',', '.')}}</span>
                    </div>
                    <div class="flex items-center gap-x-2">
                        {{-- button add service --}}
                        <div class="relative p-2 bg-gray-200 rounded-full cursor-pointer" x-data="{check: false}"
                            x-on:click="check = !check" wire:click='addService({{$service->id}})'>
                            <svg x-bind:class="check ? 'opacity-0 rotate-[180deg] duration-500' : 'duration-1000'"
                                class="absolute w-6 h-6 text-gray-800 transition-all dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12h14m-7 7V5" />
                            </svg>
                            <svg x-cloak x-bind:class="check ? 'z-10 duration-1000' : 'opacity-0 rotate-[180deg] duration-500'"
                                class="absolute w-6 h-6 text-green-800 transition-all" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 11.917 9.724 16.5 19 7.5" />
                            </svg>
                            <svg class="w-6 h-6 text-gray-800 opacity-0 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 18.5A2.493 2.493 0 0 1 7.51 20H7.5a2.468 2.468 0 0 1-2.4-3.154 2.98 2.98 0 0 1-.85-5.274 2.468 2.468 0 0 1 .92-3.182 2.477 2.477 0 0 1 1.876-3.344 2.5 2.5 0 0 1 3.41-1.856A2.5 2.5 0 0 1 12 5.5m0 13v-13m0 13a2.493 2.493 0 0 0 4.49 1.5h.01a2.468 2.468 0 0 0 2.403-3.154 2.98 2.98 0 0 0 .847-5.274 2.468 2.468 0 0 0-.921-3.182 2.477 2.477 0 0 0-1.875-3.344A2.5 2.5 0 0 0 14.5 3 2.5 2.5 0 0 0 12 5.5m-8 5a2.5 2.5 0 0 1 3.48-2.3m-.28 8.551a3 3 0 0 1-2.953-5.185M20 10.5a2.5 2.5 0 0 0-3.481-2.3m.28 8.551a3 3 0 0 0 2.954-5.185" />
                            </svg>
                        </div>
                        {{-- button expand --}}
                        <div class="p-2 bg-gray-200 rounded-full cursor-pointer" x-on:click="open = !open">
                            <svg class="w-6 h-6 text-gray-800 transition-transform dark:text-white"
                                x-bind:class="open ? 'rotate-180' : ''" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 9-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>
                <div x-cloak class="mt-3" x-collapse x-show="open">
                    {{$service->details}}
                </div>
            </div>
            @endforeach
        </div>
</section>