@section('title', 'Register | The Cajuput Spa')

<section class="flex items-center justify-center min-h-screen py-8 bg-gradient-to-bl from-green-50 via-lime-50 to-green-100 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center w-full h-full gap-3 mx-6 bg-white rounded-md shadow dark:border sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">               
        <div class="p-6 sm:p-8">
            <h1
                class="mb-4 text-4xl font-bold text-center text-gray-900 dark:text-white">
                Register
            </h1>
            <form class="h-auto space-y-4" wire:submit.prevent>
                    <div class="w-full space-y-4"
                        x-show="$wire.current_step == 0"
                        x-transition:enter="transition ease-out duration-500"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        >
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-900 dark:text-white">
                                Email</label>
                            <input type="email" name="email" id="email" placeholder="Email" wire:model="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-sm focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('email')<span class="text-xs text-red-600">*{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-900 dark:text-white">
                                Full Name</label>
                            <input type="text" name="name" id="name" placeholder="Full Name" wire:model="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-sm focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('name')<span class="text-xs text-red-600">*{{ $message }}</span> @enderror
                        </div>
                        <button x-on:click="$wire.next()"
                            class="w-full text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 tracking-widest rounded-sm text-xs px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                            Continue
                        </button>
                    </div>

                    <div class="relative grid items-start w-full grid-cols-1 space-y-4"
                        x-show="$wire.current_step == 1" 
                        x-transition:enter="transition ease-out duration-500"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        >
                        <div>
                            <label for="password" 
                                class="block text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" id="password" placeholder="Password" wire:model="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-sm focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('password')<span class="text-xs text-red-600">*{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="password_confirmation" 
                                class="block text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                            <input type="password" name="password" id="password_confirmation" placeholder="Confirm Password" wire:model="password_confirmation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-sm focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                >
                            @error('password_confirmation')<span class="text-xs text-red-600">*{{ $message }}</span> @enderror
                        </div>
                        <div class="flex space-x-2">
                            <button x-on:click="$wire.back()"
                                class="w-full text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-green-300 tracking-widest rounded-sm text-xs px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                Back
                            </button>
                            <button x-on:click="$wire.confirm()"
                                class="w-full text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 tracking-widest rounded-sm text-xs px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                Confirm
                            </button>
                        </div>
                    </div>
                
                    <div class="relative grid items-start w-full grid-cols-1 space-y-4"
                        x-show="$wire.current_step == 2"
                        x-transition:enter="transition ease-out duration-500"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        >
                        <div>
                            <label for="phone" 
                                class="block text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                            <input type="text" id="phone" placeholder="Phone Number" wire:model="phone"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-sm focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('phone')<span class="text-xs text-red-600">*{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="address" 
                                class="block text-sm font-medium text-gray-900 dark:text-white">Address</label>
                            <input type="text" name="address" id="address" placeholder="Address" wire:model="address"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-sm focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                >
                            @error('address')<span class="text-xs text-red-600">*{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="country" 
                                class="block text-sm font-medium text-gray-900 dark:text-white">Country</label>
                            <input type="text" name="country" id="country" placeholder="Country" wire:model="country"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-sm focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                >
                            @error('country')<span class="text-xs text-red-600">*{{ $message }}</span> @enderror
                        </div>
                        <div class="flex space-x-2">
                            <button x-on:click="$wire.back()"
                                class="w-full text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-green-300 tracking-widest rounded-sm text-xs px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                Back
                            </button>
                            <button x-on:click="$wire.submit()" x-show="$wire.current_step == 2"
                                class="w-full text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 tracking-widest rounded-sm text-xs px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                Create Account
                            </button>
                        </div>
                </div>

                <p class="text-sm font-light text-center text-gray-500 dark:text-gray-400">
                    Already have an account? 
                    <a href="/login" wire:navigate
                        class="font-medium text-green-700 hover:underline dark:text-green-500">
                        Login Here
                    </a>
                </p>
                
            </form>
            <livewire:auth.ssobutton>
        </div>
    </div>
</section>