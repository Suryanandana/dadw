<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to The Cajuput Spa</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    {{-- font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@200;400;600&family=Newsreader:opsz,wght@6..72,200;6..72,300;6..72,400&display=swap"
        rel="stylesheet">
    {{-- alpinejs --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    {{-- font awesome --}}
    <script src="https://kit.fontawesome.com/7eaa0f0932.js" crossorigin="anonymous"></script>
    {{-- splide --}}
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body x-data="{login: false, registrasi: false}">

    {{-- navbar --}}
    <nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 left-0 border-b border-gray-200 dark:border-gray-600">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="https://flowbite.com/" class="flex items-center">
                <img src="{{asset('img/logo.png')}}" class="h-8 mr-3" alt="Flowbite Logo">
            </a>
            <div class="flex md:order-2">
                @auth
                <div class="relative" x-data="{dropdown: false}">
                    <img x-on:click="dropdown = !dropdown" id="avatarButton" type="button" data-dropdown-toggle="userDropdown"
                        data-dropdown-placement="bottom-start" class="w-10 h-10 rounded-full cursor-pointer"
                        src="data:image/jpeg;base64,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" alt="User dropdown">
                    <!-- Dropdown menu -->
                    <div id="userDropdown" x-show="dropdown"
                        class="z-10 absolute right-0 top-0 translate-y-10 translate-x-8 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                        <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">                           
                            <div>{{auth()->user()->name}}</div>
                            <div class="font-medium truncate">{{auth()->user()->email}}</div>
                        </div>
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="avatarButton">
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                            </li>
                            <li>
                                <a href="#"
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
                <button type="button"
                    class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                    x-on:click="login = true">Sign In</button>
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
                <ul
                    class="flex font-inter flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="#"
                            class="block py-2 pl-3 pr-4 text-white bg-green-700 rounded md:bg-transparent md:text-green-700 md:p-0 md:dark:text-green-500"
                            aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-green-700 md:p-0 md:dark:hover:text-green-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">About</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-green-700 md:p-0 md:dark:hover:text-green-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Services</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-green-700 md:p-0 md:dark:hover:text-green-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- hero --}}
    <img src="{{asset('img/landing/hero.png')}}" alt="">

    {{-- our recommendation --}}
    <section class="text-gray-600 body-font">
        <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
            <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 mb-10 md:mb-0">
                <img class="object-cover object-center rounded" alt="hero" src="{{asset('img/landing/our.png')}}">
            </div>
            <div
                class="lg:flex-grow md:w-1/2 lg:pl-24 md:pl-16 flex flex-col md:items-start md:text-left items-center text-center">
                <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">Our recommendation
                </h1>
                <p class="mb-8 leading-relaxed">Copper mug try-hard pitchfork pour-over freegan heirloom neutra air
                    plant cold-pressed tacos poke beard tote bag. Heirloom echo park mlkshk tote bag selvage hot chicken
                    authentic tumeric truffaut hexagon try-hard chambray.</p>
                <div class="flex justify-center">
                    <button
                        class="inline-flex text-white bg-green-500 border-0 py-2 px-6 focus:outline-none hover:bg-green-600 rounded text-lg">Button</button>
                    <button
                        class="ml-4 inline-flex text-gray-700 bg-gray-100 border-0 py-2 px-6 focus:outline-none hover:bg-gray-200 rounded text-lg">Button</button>
                </div>
            </div>
        </div>
    </section>

    {{-- our services --}}
    <section class="text-gray-600 body-font splide">
        <div class="container px-5 py-24 mx-auto splide__track">
            <ul class="-m-4 splide__list">
                {{-- card service --}}
                <div class="p-4 md:w-1/3 splide__slide">
                    <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                        <img class="lg:h-48 md:h-36 w-full object-cover object-center"
                            src="{{asset('img/landing/body.png')}}" alt="blog">
                        <div class="p-6">
                            <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">PACKAGE</h2>
                            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">Body Treatment</h1>
                            <p class="leading-relaxed mb-3 text-justify">Lorem ipsum dolor sit amet, consectetur
                                adipisicing elit. Impedit, placeat aut expedita mollitia ex voluptate magni!</p>
                            <div class="flex items-center flex-wrap ">
                                <button type="button"
                                    class="text-green-700 flex gap-2 items-center hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">
                                    <span>Learn More</span>
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                </button>
                                <span
                                    class="text-gray-400 mr-3 inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none text-sm pr-3 py-1 border-r-2 border-gray-200">
                                    <i class="fa-solid fa-thumbs-up mr-1"></i>1.2K
                                </span>
                                <span class="text-gray-400 inline-flex items-center leading-none text-sm">
                                    <i class="fa-regular fa-comment-dots mr-1"></i>6
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- card service --}}
                <div class="p-4 md:w-1/3 splide__slide">
                    <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                        <img class="lg:h-48 md:h-36 w-full object-cover object-center"
                            src="{{asset('img/landing/massage.png')}}" alt="blog">
                        <div class="p-6">
                            <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">PACKAGE</h2>
                            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">Massage</h1>
                            <p class="leading-relaxed mb-3 text-justify">Lorem ipsum dolor sit amet, consectetur
                                adipisicing elit. Impedit, placeat aut expedita mollitia ex voluptate magni!</p>
                            <div class="flex items-center flex-wrap ">
                                <button type="button"
                                    class="text-green-700 flex gap-2 items-center hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">
                                    <span>Learn More</span>
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                </button>
                                <span
                                    class="text-gray-400 mr-3 inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none text-sm pr-3 py-1 border-r-2 border-gray-200">
                                    <i class="fa-solid fa-thumbs-up mr-1"></i>1.2K
                                </span>
                                <span class="text-gray-400 inline-flex items-center leading-none text-sm">
                                    <i class="fa-regular fa-comment-dots mr-1"></i>6
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- card service --}}
                <div class="p-4 md:w-1/3 splide__slide">
                    <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                        <img class="lg:h-48 md:h-36 w-full object-cover object-center"
                            src="{{asset('img/landing/hair.png')}}" alt="blog">
                        <div class="p-6">
                            <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">PACKAGE</h2>
                            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">Hair Treatment</h1>
                            <p class="leading-relaxed mb-3 text-justify">Lorem ipsum dolor sit amet, consectetur
                                adipisicing elit. Impedit, placeat aut expedita mollitia ex voluptate magni!</p>
                            <div class="flex items-center flex-wrap ">
                                <button type="button"
                                    class="text-green-700 flex gap-2 items-center hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">
                                    <span>Learn More</span>
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                </button>
                                <span
                                    class="text-gray-400 mr-3 inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none text-sm pr-3 py-1 border-r-2 border-gray-200">
                                    <i class="fa-solid fa-thumbs-up mr-1"></i>1.2K
                                </span>
                                <span class="text-gray-400 inline-flex items-center leading-none text-sm">
                                    <i class="fa-regular fa-comment-dots mr-1"></i>6
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- card service --}}
                <div class="p-4 md:w-1/3 splide__slide">
                    <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                        <img class="lg:h-48 md:h-36 w-full object-cover object-center"
                            src="{{asset('img/landing/manicure.webp')}}" alt="blog">
                        <div class="p-6">
                            <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">PACKAGE</h2>
                            <h1 class="title-font text-lg font-medium text-gray-900 mb-3">Manicure</h1>
                            <p class="leading-relaxed mb-3 text-justify">Lorem ipsum dolor sit amet, consectetur
                                adipisicing elit. Impedit, placeat aut expedita mollitia ex voluptate magni!</p>
                            <div class="flex items-center flex-wrap ">
                                <button type="button"
                                    class="text-green-700 flex gap-2 items-center hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">
                                    <span>Learn More</span>
                                    <i class="fa-solid fa-arrow-right-long"></i>
                                </button>
                                <span
                                    class="text-gray-400 mr-3 inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none text-sm pr-3 py-1 border-r-2 border-gray-200">
                                    <i class="fa-solid fa-thumbs-up mr-1"></i>1.2K
                                </span>
                                <span class="text-gray-400 inline-flex items-center leading-none text-sm">
                                    <i class="fa-regular fa-comment-dots mr-1"></i>6
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </ul>
        </div>
    </section>

    {{-- testimonial --}}
    <section class="bg-green-200 p-8">
        <h1 class="text-3xl text-center font-semibold mb-5">What People Think</h1>
        <div class="flex gap-5 p-5">
            {{-- card --}}
            <div class="w-1/3">
                <div class="bg-white p-5 rounded-lg flex flex-col relative">
                    <span class="text-gray-500">Hair Treatment (3 pax)</span>
                    <span>“Not as great as the advertise, quite dissappointed with the vibes”</span>
                    <div class="ml-auto text-gray-500">
                        <i class="fa-solid fa-thumbs-down"></i>
                        <span>Not Recommended</span>
                    </div>
                    <div class="w-0 h-0 
                                border-l-[20px] border-l-transparent
                                border-t-[15px] border-t-white
                                border-r-[20px] border-r-transparent
                                absolute bottom-0 left-0 translate-y-3 translate-x-6 z-10">
                    </div>
                </div>
                <div class="flex items-center gap-2 mt-4 ml-5">
                    <img src="{{asset('img/landing/avatar.png')}}" alt="" class="scale-90">
                    <div class="flex flex-col">
                        <span class="font-semibold">Mohammed Abdullah</span>
                        <span class="text-sm text-gray-500">27 Oct 2023</span>
                    </div>
                </div>
            </div>
            {{-- card --}}
            <div class="w-1/3">
                <div class="bg-white p-5 rounded-lg flex flex-col relative">
                    <span class="text-gray-500">Massages (1 pax)</span>
                    <span>““Pretty Amazing Experience, everything provides here are perfect!””</span>
                    <div class="ml-auto text-gray-500">
                        <i class="fa-solid fa-thumbs-up"></i>
                        <span>Recommended</span>
                    </div>
                    <div class="w-0 h-0 
                                border-l-[20px] border-l-transparent
                                border-t-[15px] border-t-white
                                border-r-[20px] border-r-transparent
                                absolute bottom-0 left-0 translate-y-3 translate-x-6 z-10">
                    </div>
                </div>
                <div class="flex items-center gap-2 mt-4 ml-5">
                    <img src="{{asset('img/landing/avatar.png')}}" alt="" class="scale-90">
                    <div class="flex flex-col">
                        <span class="font-semibold">Mohammed Abdullah</span>
                        <span class="text-sm text-gray-500">27 Oct 2023</span>
                    </div>
                </div>
            </div>
            {{-- card --}}
            <div class="w-1/3">
                <div class="bg-white p-5 rounded-lg flex flex-col relative">
                    <span class="text-gray-500">Body Treatment (3 pax)</span>
                    <span>“All of the workers are super talented, i think this is the best spa in the world!”</span>
                    <div class="ml-auto text-gray-500">
                        <i class="fa-solid fa-thumbs-up"></i>
                        <span>Recommended</span>
                    </div>
                    <div class="w-0 h-0 
                                border-l-[20px] border-l-transparent
                                border-t-[15px] border-t-white
                                border-r-[20px] border-r-transparent
                                absolute bottom-0 left-0 translate-y-3 translate-x-6 z-10">
                    </div>
                </div>
                <div class="flex items-center gap-2 mt-4 ml-5">
                    <img src="{{asset('img/landing/avatar.png')}}" alt="" class="scale-90">
                    <div class="flex flex-col">
                        <span class="font-semibold">Mohammed Abdullah</span>
                        <span class="text-sm text-gray-500">20 Oct 2023</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- motto --}}
    <section>
        <h2 class="text-3xl font-semibold text-center my-10">Indulge, Relax, Rejuvenate.</h2>
        <p class="text-center px-28">At our spa, we believe in the transformative power of relaxation and self-care. Our
            dedicated team of professionals is here to provide you with a blissful escape from the everyday hustle and
            bustle.</p>
        <p class="text-center px-20 mt-5">Immerse yourself in a world of serenity as you choose from a variety of
            luxurious treatments designed to revitalize your mind, body, and spirit. From soothing massages and
            invigorating facials to holistic wellness rituals, we offer a range of services to cater to your unique
            needs.</p>
        <div class="flex justify-center mt-5">
            <button type="button"
                class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Book
                Now</button>
        </div>
    </section>

    {{-- navigation and contact --}}
    <section class="flex px-10 mt-16 gap-10">
        <div class="w-[10%]">
            <span class="font-semibold">Sitemap</span>
            <ul class="list-disc list-inside ml-2">
                <li>Home</li>
                <li>About Us</li>
                <li>Offers</li>
                <li>Spa</li>
                <li>Reviews</li>
                <li>Gallery</li>
                <li>Blog</li>
                <li>Contact Us</li>
            </ul>
        </div>
        <div class="w-[50%] flex flex-col">
            <label for="message" class="block mb-4 text-sm text-gray-900 dark:text-white font-semibold">Reach Us</label>
            <input type="text" id="first_name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Your email address" required>
            <textarea id="message" rows="4"
                class="block p-2.5 my-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Message"></textarea>
            <button type="button"
                class="text-white w-fit ml-auto bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-md text-sm px-5 py-2.5 text-center mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Send</button>
        </div>
        <div class="flex flex-col w-[40%]">
            <span class="font-semibold">Location</span>
            <span class="text-sm mb-4">Lorem St. No. 20 Ipsum, Dolor del Amet, Laddowashinghton AC, 810280</span>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1737.6221882978507!2d-98.48650795000005!3d29.421653200000023!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x865c58aa57e6a56f%3A0xf08a9ad66f03e879!2sHenry+B.+Gonzalez+Convention+Center!5e0!3m2!1sen!2sus!4v1393884854786"
                height="250" frameborder="0" style="border:0"></iframe>
        </div>
    </section>

    {{-- footer --}}
    <footer class="border-t border-gray-300 mt-6 py-4 px-10 flex justify-between">
        <div class="flex gap-4">
            <i class="fa-brands fa-facebook text-xl"></i>
            <i class="fa-brands fa-instagram text-xl"></i>
            <i class="fa-brands fa-whatsapp text-xl"></i>
        </div>
        <div class="flex items-center">
            <span class="text-sm">© 2023 The Cajuput SPA All Right Reserved</span>
        </div>
    </footer>

    {{-- pop up login dan registrasi --}}
    <section x-cloak x-data="{notif: false}">
        <div x-show="login || registrasi" x-on:click="login = false, registrasi = false"
            class="w-screen h-screen bg-gray-100 backdrop-filter backdrop-blur-[2px] bg-opacity-10 rounded-lg fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-20">
        </div>
        <form x-show="login" action="login" method="POST"
            class="fixed rounded-lg shadow-2xl left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 px-5 py-10 bg-white z-30 flex flex-col items-center w-96">
            @csrf
            <h3 class="text-green-400 text-3xl text-center font-bold mb-8">Login</h3>
            <div x-show="notif"
                class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <span class="font-medium">Registrasi Berhasil!</span> Silahkan login dengan akun yang telah dibuat.
            </div>
            <input name="email" type="text" id="first_name"
                class="bg-gray-50 border border-green-300 text-green-900 text-sm rounded-lg focus:ring-green-500 focus:outline-green-400 focus:border-green-500 block w-full p-2.5 dark:bg-green-700 dark:border-green-600 dark:placeholder-green-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                placeholder="Username" required>
            <input name="password" type="password" id="first_name"
                class="bg-gray-50 my-4 border border-green-300 text-green-900 text-sm rounded-lg focus:ring-green-500 focus:outline-green-400 focus:border-green-500 block w-full p-2.5 dark:bg-green-700 dark:border-green-600 dark:placeholder-green-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                placeholder="Password" required>
                <a href="{{ route('password.request') }}" class="mb-3 text-blue-400 text-sm">Forgot Password ?</a>
            <input type="submit"
                class="focus:outline-none text-white w-full bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 cursor-pointer"
                value="Sign In">
            <a href="#" x-on:click="login = false, registrasi = true" class="underline text-green-700 text-sm mt-3">Does
                not have an account?</a>
        </form>
        <form action="register" method="POST" x-show="registrasi" action="#"
            class="fixed rounded-lg shadow-2xl left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 px-5 py-10 bg-white z-30 flex flex-col items-center w-96">
            @csrf
            <h3 class="text-green-400 text-3xl text-center font-bold mb-8">Registrasi</h3>
            <input type="text" id="first_name"
                class="bg-gray-50 border border-green-300 text-green-900 text-sm rounded-lg focus:ring-green-500 focus:outline-green-400 focus:border-green-500 block w-full p-2.5 dark:bg-green-700 dark:border-green-600 dark:placeholder-green-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                placeholder="Full Name" required name="name">
            <input type="text" id="first_name"
                class="bg-gray-50 my-4 border border-green-300 text-green-900 text-sm rounded-lg focus:ring-green-500 focus:outline-green-400 focus:border-green-500 block w-full p-2.5 dark:bg-green-700 dark:border-green-600 dark:placeholder-green-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                placeholder="Phone Number" required name="phone">
            <input type="text" id="first_name"
                class="bg-gray-50 border border-green-300 text-green-900 text-sm rounded-lg focus:ring-green-500 focus:outline-green-400 focus:border-green-500 block w-full p-2.5 dark:bg-green-700 dark:border-green-600 dark:placeholder-green-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                placeholder="Email" required name="email">
            <input type="password" id="first_name"
                class="bg-gray-50 my-4 border border-green-300 text-green-900 text-sm rounded-lg focus:ring-green-500 focus:outline-green-400 focus:border-green-500 block w-full p-2.5 dark:bg-green-700 dark:border-green-600 dark:placeholder-green-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                placeholder="Create Password" required name="password">
            <input x-on:click="notif = true, login = true, registrasi = false" type="submit"
                class="focus:outline-none text-white w-full bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 cursor-pointer"
                value="Sign Up">
            <a href="#" x-on:click="login = true, registrasi = false, notif = false"
                class="underline text-green-700 text-sm mt-3">Already have an account?</a>
        </form>
    </section>

    {{-- splide config --}}
    <script>
        new Splide( '.splide', {
            perPage: 3,
            type: 'loop',
            breakpoints: {
                640: {
                    perPage: 1,
                }
            }
        } ).mount();        
    </script>
</body>

</html>