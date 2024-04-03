<div x-data="{show: false}">
    <div x-on:click="show = true" class="fixed z-50 p-2 bg-green-700 rounded-full cursor-pointer right-5 bottom-5">
        <svg class="w-10 h-10 text-gray-100 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M14.079 6.839a3 3 0 0 0-4.255.1M13 20h1.083A3.916 3.916 0 0 0 18 16.083V9A6 6 0 1 0 6 9v7m7 4v-1a1 1 0 0 0-1-1h-1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1Zm-7-4v-6H5a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h1Zm12-6h1a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-1v-6Z" />
        </svg>
    </div>
    <div x-cloak x-show="show" @click.away="show = false"
        class="fixed z-10 w-[30%] flex flex-col pt-5 pb-2 bg-green-200 rounded-xl gap-y-2 right-5 bottom-20">
        <div class="flex flex-col h-96 overflow-auto items-start gap-2.5">
            @foreach ($chats as $chat)
            <div
                class="flex flex-col w-full max-w-[320px] p-4 border-gray-200 bg-gray-100 dark:bg-gray-700
                {{auth()->user()->id == $chat->sender_id ? "ml-10 mr-5 rounded-s-xl rounded-b-xl" : "ml-5 mr-10 rounded-e-xl rounded-es-xl"}}">
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
                    class="block w-full p-4 pr-20 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Ketik pesan" required />
                <button type="submit"
                    class="text-white absolute right-2 top-1/2 -translate-y-1/2 end-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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