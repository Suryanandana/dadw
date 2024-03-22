<nav id="nav-container" class="animate-fadein md:animate-fadeout dark:bg-gray-900 fixed w-full z-50 top-0 left-0 border-gray-200">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between w-full p-4 mx-auto">
        <a href="/" class="flex items-center">
            <div class="flex justify-center items-center">
                <svg class="h-10 w-10 text-green-600" xmlns="http://www.w3.org/2000/svg" width="47" height="67" viewBox="0 0 47 67" fill="none">
                    <path d="M32.2534 35.0758C31.9665 28.4062 32.7362 19.9136 35.6545 16.0616C38.3446 19.351 40.1858 26.6491 40.6336 33.7301C41.1442 41.8027 40.4765 50.7097 41.0175 56.0938C35.8984 50.3284 32.5984 43.0931 32.2534 35.0758Z" fill="currentColor"/>
                    <path d="M15.0568 43.3456C15.5612 41.1027 17.8277 37.4735 19.9215 36.4858C20.4374 39.2014 20.214 42.4674 19.5212 45.4846C18.4449 49.0549 16.5138 52.5348 14.6788 54.0316C14.2252 50.2264 14.2398 46.9778 15.0568 43.3456Z" fill="currentColor"/>
                    <path d="M22.2921 43.579C21.913 33.6489 25.8593 29.1691 29.0237 25.584C28.1385 33.1697 28.2064 39.6035 28.9245 46.6622C29.7433 54.7094 30.8315 61.3839 27.8856 66.8618C27.3108 59.2897 22.821 57.435 22.2921 43.579Z" fill="currentColor"/>
                    <path d="M15.2263 33.6831C20.1419 30.5857 21.3679 28.8592 24.303 24.8994C20.0219 25.4477 16.4366 26.564 13.9915 27.9601C8.90698 30.8634 7.22337 34.6077 6.51866 39.1355C9.50152 36.2873 13.3256 34.8808 15.2263 33.6831Z" fill="currentColor"/>
                    <path d="M14.6743 14.123C9.32664 16.4918 2.05933 21.653 1.27074 26.7197C5.92812 24.4634 14.5338 23.3186 21.1314 20.4254C29.3082 16.8398 32.3821 14.1161 37.1005 11.2094C29.9544 8.88255 20.7656 11.4248 14.6743 14.123Z" fill="currentColor"/>
                </svg>
                <span id="logo" class="font-serif text-xl text-gray-700 md:text-white">The Cajuput Spa</span>
            </div>
        </a>
        <div class="flex md:order-2 gap-3">
            @auth
            <div class="relative" x-data="{dropdown: false}">
                <img x-on:click="dropdown = !dropdown" class="w-10 h-10 rounded-full cursor-pointer"
                    src="data:image/jpeg;base64,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" alt="User dropdown">
                <!-- Dropdown menu -->
                <div x-show="dropdown"
                    class="z-10 absolute right-0 top-0 translate-y-10 translate-x-8 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                    <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">                           
                        <div>{{auth()->user()->name}}</div>
                        <div class="font-medium truncate">{{auth()->user()->email}}</div>
                    </div>
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
                        <li>
                            <a href="{{Auth::user()->level == 'customer' ? '/transaction' : '/dashboard'}}"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Transaction</a>
                        </li>
                    </ul>
                    <div class="py-1">
                        <a href="logout"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                            out</a>
                    </div>
                </div>
            </div>
            @else
            <a href="/login"
                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 text-center md:mr-0 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                x-on:click="login = true">Sign In</a>
            @endauth
            <button data-collapse-toggle="navbar-sticky" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
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
                class="text-gray-700 md:text-white flex flex-col list-inside gap-3 p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg md:flex-row md:space-x-8 md:mt-0 md:border-0">
                <li class="text-current">
                    <a href="/" id="nav-text"
                        class="py-2 pl-3 pr-4 md:hover:text-green-700 md:p-0">Home</a>
                </li>
                <li>
                    <a href="#" id="nav-text"
                        class="py-2 pl-3 pr-4 md:hover:text-green-700 md:p-0">About</a>
                </li>
                <li>
                    <a href="#" id="nav-text"
                        class="py-2 pl-3 pr-4 md:hover:text-green-700 md:p-0">Services</a>
                </li>
                <li>
                    <a href="#" id="nav-text"
                        class="py-2 pl-3 pr-4 md:hover:text-green-700 md:p-0">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>