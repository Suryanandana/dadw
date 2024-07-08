<section>
    <nav id="nav-container" class="fixed top-0 left-0 z-50 w-full border-gray-200 select-none md:absolute animate-fadein md:animate-fadeout dark:bg-gray-900">
        <div class="flex flex-wrap items-center justify-between w-full max-w-screen-xl p-4 mx-auto">
            <a href="/" wire:navigate class="flex items-center">
                <div class="flex items-center justify-center">
                    <svg class="w-10 h-10 text-green-600" xmlns="http://www.w3.org/2000/svg" width="47" height="67" viewBox="0 0 47 67" fill="none">
                        <path d="M32.2534 35.0758C31.9665 28.4062 32.7362 19.9136 35.6545 16.0616C38.3446 19.351 40.1858 26.6491 40.6336 33.7301C41.1442 41.8027 40.4765 50.7097 41.0175 56.0938C35.8984 50.3284 32.5984 43.0931 32.2534 35.0758Z" fill="currentColor"/>
                        <path d="M15.0568 43.3456C15.5612 41.1027 17.8277 37.4735 19.9215 36.4858C20.4374 39.2014 20.214 42.4674 19.5212 45.4846C18.4449 49.0549 16.5138 52.5348 14.6788 54.0316C14.2252 50.2264 14.2398 46.9778 15.0568 43.3456Z" fill="currentColor"/>
                        <path d="M22.2921 43.579C21.913 33.6489 25.8593 29.1691 29.0237 25.584C28.1385 33.1697 28.2064 39.6035 28.9245 46.6622C29.7433 54.7094 30.8315 61.3839 27.8856 66.8618C27.3108 59.2897 22.821 57.435 22.2921 43.579Z" fill="currentColor"/>
                        <path d="M15.2263 33.6831C20.1419 30.5857 21.3679 28.8592 24.303 24.8994C20.0219 25.4477 16.4366 26.564 13.9915 27.9601C8.90698 30.8634 7.22337 34.6077 6.51866 39.1355C9.50152 36.2873 13.3256 34.8808 15.2263 33.6831Z" fill="currentColor"/>
                        <path d="M14.6743 14.123C9.32664 16.4918 2.05933 21.653 1.27074 26.7197C5.92812 24.4634 14.5338 23.3186 21.1314 20.4254C29.3082 16.8398 32.3821 14.1161 37.1005 11.2094C29.9544 8.88255 20.7656 11.4248 14.6743 14.123Z" fill="currentColor"/>
                    </svg>
                    <span id="logo" class="hidden min-[360px]:block font-serif text-xl text-gray-700 md:text-white">The Cajuput Spa</span>
                </div>
            </a>
            <div class="flex gap-3 md:order-2">
                @auth
                <div class="relative" x-data="{dropdown: false}">
                    <div class="hover:cursor-pointer">
                        <div class="text-green-600 bg-green-200 border border-green-600 rounded-full size-12"
                         x-on:click="dropdown = !dropdown" class="w-10 h-10 rounded-full cursor-pointer">
                            <svg class="mx-auto text-green-600 size-10" xmlns="http://www.w3.org/2000/svg" width="47" height="67" viewBox="0 0 47 67" fill="none">
                                <path d="M32.2534 35.0758C31.9665 28.4062 32.7362 19.9136 35.6545 16.0616C38.3446 19.351 40.1858 26.6491 40.6336 33.7301C41.1442 41.8027 40.4765 50.7097 41.0175 56.0938C35.8984 50.3284 32.5984 43.0931 32.2534 35.0758Z" fill="currentColor"/>
                                <path d="M15.0568 43.3456C15.5612 41.1027 17.8277 37.4735 19.9215 36.4858C20.4374 39.2014 20.214 42.4674 19.5212 45.4846C18.4449 49.0549 16.5138 52.5348 14.6788 54.0316C14.2252 50.2264 14.2398 46.9778 15.0568 43.3456Z" fill="currentColor"/>
                                <path d="M22.2921 43.579C21.913 33.6489 25.8593 29.1691 29.0237 25.584C28.1385 33.1697 28.2064 39.6035 28.9245 46.6622C29.7433 54.7094 30.8315 61.3839 27.8856 66.8618C27.3108 59.2897 22.821 57.435 22.2921 43.579Z" fill="currentColor"/>
                                <path d="M15.2263 33.6831C20.1419 30.5857 21.3679 28.8592 24.303 24.8994C20.0219 25.4477 16.4366 26.564 13.9915 27.9601C8.90698 30.8634 7.22337 34.6077 6.51866 39.1355C9.50152 36.2873 13.3256 34.8808 15.2263 33.6831Z" fill="currentColor"/>
                                <path d="M14.6743 14.123C9.32664 16.4918 2.05933 21.653 1.27074 26.7197C5.92812 24.4634 14.5338 23.3186 21.1314 20.4254C29.3082 16.8398 32.3821 14.1161 37.1005 11.2094C29.9544 8.88255 20.7656 11.4248 14.6743 14.123Z" fill="currentColor"/>
                            </svg>
                        </div>
                        @empty(auth()->user()->email_verified_at || session('message'))
                        <div class="absolute inline-flex items-center justify-center w-5 h-5 text-xs text-white bg-red-500 border-2 border-white rounded-full -top-1 -end-1 dark:border-gray-900">
                            1
                        </div>
                        @endempty
                    </div>
                    <!-- Dropdown menu -->
                    <div x-show="dropdown"
                        class="absolute right-0 z-10 translate-x-8 translate-y-10 bg-white divide-y divide-gray-100 rounded-lg shadow top-5 w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <div class="px-4 py-3 text-gray-900 dark:text-white">                           
                            <div>Hello! {{auth()->user()->name}}</div>
                            <div class="text-xs text-gray-500 truncate">{{auth()->user()->email}}</div>
                        </div>
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
                            <li>
                                <a href="/profile"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profile</a>
                            </li>
                            <li>
                                <a href="{{Auth::user()->level == 'customer' ? '/transaction' : '/dashboard'}}"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Transaction</a>
                            </li>
                            @empty(auth()->user()->email_verified_at || session('message'))
                            <li>
                                <form action="/email/verification-notification" method="POST" class="">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center justify-between w-full px-4 py-2 text-left hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        Verify Your Email
                                        <span class="w-3 h-3 bg-red-500 rounded-full dark:border-gray-900"></span>
                                    </button>
                                </form>
                            </li>
                            @endempty
                        </ul>
                        <div class="py-1">
                            <a href="logout"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                                out</a>
                        </div>
                    </div>
                </div>
                @else
                <button href="/login" wire:navigate
                    class="inline-flex px-8 py-3 text-xs tracking-widest text-white bg-green-700 border-0 rounded-sm focus:outline-none hover:bg-green-800"
                    >SIGN IN
                </button>
                @endauth
                <button data-collapse-toggle="navbar-sticky" type="button"
                    class="inline-flex items-center justify-center w-10 h-10 p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul id="nav-list"
                    class="flex flex-col gap-3 p-4 mt-4 text-sm font-medium text-gray-700 list-inside border border-gray-100 rounded-lg md:text-white md:p-0 md:flex-row md:space-x-8 md:mt-0 md:border-0">
                    <li>
                        <a href="/" id="nav-text" wire:navigate
                            class="py-2 pl-3 pr-4 md:hover:text-green-400 md:p-0">Home</a>
                    </li>
                    <li>
                        <a href="#" id="nav-text"
                            class="py-2 pl-3 pr-4 md:hover:text-green-400 md:p-0">About</a>
                    </li>
                    <li>
                        <a href="#" id="nav-text"
                            class="py-2 pl-3 pr-4 md:hover:text-green-400 md:p-0">Services</a>
                    </li>
                    <li>
                        <a href="#" id="nav-text"
                            class="py-2 pl-3 pr-4 md:hover:text-green-400 md:p-0">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    @empty(!auth()->user())
    @if(!empty(session('message')))
    
    <div id="toast-message-cta" class="fixed z-50 right-2 top-[6rem] w-full max-w-xs px-4 py-6 text-gray-500 bg-white rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-400" role="alert">
        <div class="flex">
            <div class="text-sm font-normal ms-3">
                <span class="mb-2 text-sm font-semibold text-gray-900 dark:text-white">Notification!</span>
                <div class="mb-2 text-sm font-normal">
                    <p>{{session('message')}}</p>
                </div> 
            </div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white justify-center items-center flex-shrink-0 text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-message-cta" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    </div>
    
    @elseif(empty(auth()->user()->email_verified_at))
    
    <div id="toast-message-cta" class="fixed z-50 right-2 top-[6rem] w-full max-w-xs px-4 py-6 text-gray-500 bg-white rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-400" role="alert">
        <div class="flex">
            <div class="text-sm font-normal ms-3">
                <span class="mb-2 text-sm font-semibold text-gray-900 dark:text-white">Your email is not verified</span>
                <div class="mb-2 text-sm">
                    <p>Greeting! {{auth()->user()->name}},</p>
                    <p>your account is not verified in our system, please check your email to verify.</p>
                </div> 
                <form action="/email/verification-notification" method="POST">
                    @csrf
                    <button type="submit" class="inline-flex px-5 py-1.5 text-xs font-medium text-center text-white bg-green-700 rounded-sm hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                        Verify Now
                    </button>
                </form>
            </div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white justify-center items-center flex-shrink-0 text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-message-cta" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    </div>
    
    @endif
    @endempty
    
</section>