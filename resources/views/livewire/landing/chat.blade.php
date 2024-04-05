<div>
    {{-- chat --}}
    @auth
        @if (Auth::user()->level == 'customer')
        <div x-data="{show: false}">
            <div x-on:click="show = true" class="fixed z-50 p-2 bg-green-700 rounded-full cursor-pointer right-5 bottom-5">
                <svg class="w-10 h-10 text-gray-100 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14.079 6.839a3 3 0 0 0-4.255.1M13 20h1.083A3.916 3.916 0 0 0 18 16.083V9A6 6 0 1 0 6 9v7m7 4v-1a1 1 0 0 0-1-1h-1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1Zm-7-4v-6H5a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h1Zm12-6h1a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-1v-6Z" />
                </svg>
            </div>
            <div x-cloak x-show="show" @click.away="show = false" x-transition
                class="fixed z-10 w-[30%] flex flex-col pt-5 pb-2 bg-green-200 rounded-xl gap-y-2 right-5 bottom-20">
                <div class="overflow-auto h-96">
                    @foreach ($chats as $chat)
                    <div
                        class="flex flex-col w-fit max-w-[320px] p-4 my-3 border-gray-200 bg-gray-100 dark:bg-gray-700
                        {{auth()->user()->id == $chat->sender_id ? "ml-auto -translate-x-3 rounded-s-xl rounded-b-xl" : "ml-3 rounded-e-xl rounded-es-xl"}}">
                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">{{auth()->user()->id == $chat->sender_id ? 'You' : 'Staff'}}</span>
                            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">{{$chat->created_at}}</span>
                        </div>
                        <p class="text-sm font-normal py-2.5 text-gray-900 dark:text-white overflow-auto">
                            {{ $chat->message }}
                        </p>
                    </div>
                    @endforeach
                </div>       
                <form wire:submit="save">
                    <div class="relative mx-5">
                        <input type="text" wire:model="message"
                            class="block w-full p-4 pr-20 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                            placeholder="Ketik pesan" required />
                        <button type="submit"
                            class="text-white absolute right-2 top-1/2 -translate-y-1/2 end-2.5 bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            <svg class="w-6 h-6 text-gray-100 rotate-90 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m12 18-7 3 7-18 7 18-7-3Zm0 0v-5" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    @endauth
    @guest
    <div x-data="{show: false}">
        <div x-on:click="show = true" class="fixed z-50 p-2 rounded-full cursor-pointer bg-green-700/70 hover:bg-green-700 right-5 bottom-5">
            <svg class="w-10 h-10 text-gray-100 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M14.079 6.839a3 3 0 0 0-4.255.1M13 20h1.083A3.916 3.916 0 0 0 18 16.083V9A6 6 0 1 0 6 9v7m7 4v-1a1 1 0 0 0-1-1h-1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1Zm-7-4v-6H5a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h1Zm12-6h1a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-1v-6Z" />
            </svg>
        </div>
        <div x-cloak x-show="show" @click.away="show = false" x-transition
            class="fixed z-10 flex flex-col bg-green-200 rounded-xl gap-y-2 right-5 bottom-20">
            <div class="flex flex-col items-center justify-center max-w-sm p-6 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                <svg class="w-10 h-10 text-gray-800 dark:text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 13 16h-2a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 12 21Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                <a href="#">
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-center text-gray-900 dark:text-white">You need to log in!</h5>
                </a>
                <p class="mb-3 font-normal text-center text-gray-600 dark:text-gray-400">You must log in or register by clicking the link below to contact our customer service</p>
                <a href="/login" class="inline-flex items-center font-medium text-blue-600 hover:underline">
                    Login now
                    <svg class="w-3 h-3 ms-2.5 rtl:rotate-[270deg]" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
    @endguest
</div>