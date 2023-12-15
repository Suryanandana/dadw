<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>The Cajuput Spa</title>
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
        [x-cloak] { display: none !important; }
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
                <button type="button"
                    class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 text-center mr-3 md:mr-0 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" x-on:click="login = true">Sign In</button>
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
                <p class="mb-8 leading-relaxed">Indulge in our exclusive Cajuput Signature Rejuvenation, a harmonious blend of exfoliation and hydration. 
                    This treatment starts with a gentle body scrub, followed by a nourishing wrap infused with essential oils derived from the Cajuput tree. 
                    Surrender to the soothing ambiance as our therapists work their magic, leaving your skin revitalized and your senses refreshed.</p>
                <div class="flex justify-center">
                    <button
                        class="inline-flex text-white bg-green-500 border-0 py-2 px-6 focus:outline-none hover:bg-green-600 rounded text-lg">Book Here!</button>
                    <!-- <button 
                        class="ml-4 inline-flex text-gray-700 bg-gray-100 border-0 py-2 px-6 focus:outline-none hover:bg-gray-200 rounded text-lg">Button</button>-->
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
                            <p class="leading-relaxed mb-3 text-justify">Indulge in the ultimate self-care experience with our rejuvenating body treatment services! 
                                Step into a world of relaxation and wellness as our skilled therapists pamper you with luxurious treatments designed to nourish your body and soothe your senses.</p>
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
                            <p class="leading-relaxed mb-3 text-justify">Embark on a journey of serenity and rejuvenation with our exceptional massage services. 
                                Unwind, relax, and let the stresses of the day melt away as our skilled therapists expertly address your unique needs.</p>
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
                            <p class="leading-relaxed mb-3 text-justify">Revitalize your locks and unleash the full potential of your hair with our exceptional hair treatment services. 
                                Step into a world of beauty and self-care where our expert stylists are dedicated to enhancing the health, shine, and overall allure of your hair.</p>
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
                            <p class="leading-relaxed mb-3 text-justify">Treat yourself to a moment of luxury and care that extends beyond aesthetics to promote healthier, more radiant hands. 
                                Our wide selection of high-quality nail colors and products ensures that your manicure is not only visually stunning but also long-lasting.</p>
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
                    <span>"The Luxurious Scalp Renewal at The Cajuput Spa is a must-try. The scalp massage was so relaxing, and the treatment left my scalp feeling rejuvenated. 
                        My hair has never looked healthier. A truly pampering experience that I'll be coming back for regularly!"</span>
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
                        <span class="font-semibold">Ariana Kjelberg</span>
                        <span class="text-sm text-gray-500">27 Oct 2023</span>
                    </div>
                </div>
            </div>
            {{-- card --}}
            <div class="w-1/3">
                <div class="bg-white p-5 rounded-lg flex flex-col relative">
                    <span class="text-gray-500">Massages (1 pax)</span>
                    <span>"The massage services at The Cajuput Spa are pure bliss! The therapist's skilled touch and the tranquil ambiance create an unparalleled relaxation experience. 
                        It's a sanctuary for rejuvenation—I left feeling utterly refreshed. Highly recommended!"</span>
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
                        <span class="font-semibold">Richard Felix</span>
                        <span class="text-sm text-gray-500">27 Oct 2023</span>
                    </div>
                </div>
            </div>
            {{-- card --}}
            <div class="w-1/3">
                <div class="bg-white p-5 rounded-lg flex flex-col relative">
                    <span class="text-gray-500">Body Treatment (3 pax)</span>
                    <span>"The body treatment services are a true escape to serenity. The tailored approach and luxurious ambiance elevate the experience. 
                        From soothing wraps to invigorating scrubs, each session is a journey to relaxation and radiant well-being. A must-try for anyone seeking ultimate pampering!"</span>
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
                        <span class="font-semibold">Mayrika Diva</span>
                        <span class="text-sm text-gray-500">20 Oct 2023</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- motto --}}
    <section>
        <h2 class="text-3xl font-semibold text-center my-10">Indulge, Relax & Rejuvenate.</h2>
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
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1737.6221882978507!2d-98.48650795000005!3d29.421653200000023!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x865c58aa57e6a56f%3A0xf08a9ad66f03e879!2sHenry+B.+Gonzalez+Convention+Center!5e0!3m2!1sen!2sus!4v1393884854786" height="250" frameborder="0" style="border:0"></iframe>
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
    <section x-cloak>
        <div x-show="login || registrasi" x-on:click="login = false, registrasi = false" class="w-screen h-screen bg-gray-100 backdrop-filter backdrop-blur-[2px] bg-opacity-10 rounded-lg fixed left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-20"></div>
        <form x-show="login" action="#" class="fixed rounded-lg shadow-2xl left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 px-5 py-10 bg-white z-30 flex flex-col items-center w-96">
            <h3 class="text-green-400 text-3xl text-center font-bold mb-8">Login</h3>
            <input type="text" id="first_name" class="bg-gray-50 border border-green-300 text-green-900 text-sm rounded-lg focus:ring-green-500 focus:outline-green-400 focus:border-green-500 block w-full p-2.5 dark:bg-green-700 dark:border-green-600 dark:placeholder-green-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500" placeholder="Username" required>
            <input type="password" id="first_name" class="bg-gray-50 my-4 border border-green-300 text-green-900 text-sm rounded-lg focus:ring-green-500 focus:outline-green-400 focus:border-green-500 block w-full p-2.5 dark:bg-green-700 dark:border-green-600 dark:placeholder-green-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500" placeholder="Password" required>
            <input type="submit" class="focus:outline-none text-white w-full bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 cursor-pointer" value="Sign In">
            <a href="#" x-on:click="login = false, registrasi = true" class="underline text-green-700 text-sm mt-3">Does not have an account?</a>
        </form>
        <form x-show="registrasi" action="#" class="fixed rounded-lg shadow-2xl left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 px-5 py-10 bg-white z-30 flex flex-col items-center w-96">
            <h3 class="text-green-400 text-3xl text-center font-bold mb-8">Registrasi</h3>
            <input type="text" id="first_name" class="bg-gray-50 border border-green-300 text-green-900 text-sm rounded-lg focus:ring-green-500 focus:outline-green-400 focus:border-green-500 block w-full p-2.5 dark:bg-green-700 dark:border-green-600 dark:placeholder-green-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500" placeholder="Full Name" required>
            <input type="text" id="first_name" class="bg-gray-50 my-4 border border-green-300 text-green-900 text-sm rounded-lg focus:ring-green-500 focus:outline-green-400 focus:border-green-500 block w-full p-2.5 dark:bg-green-700 dark:border-green-600 dark:placeholder-green-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500" placeholder="Phone Number" required>
            <input type="text" id="first_name" class="bg-gray-50 border border-green-300 text-green-900 text-sm rounded-lg focus:ring-green-500 focus:outline-green-400 focus:border-green-500 block w-full p-2.5 dark:bg-green-700 dark:border-green-600 dark:placeholder-green-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500" placeholder="Email" required>
            <input type="password" id="first_name" class="bg-gray-50 my-4 border border-green-300 text-green-900 text-sm rounded-lg focus:ring-green-500 focus:outline-green-400 focus:border-green-500 block w-full p-2.5 dark:bg-green-700 dark:border-green-600 dark:placeholder-green-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500" placeholder="Create Password" required>
            <input type="submit" class="focus:outline-none text-white w-full bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 cursor-pointer" value="Sign Up">
            <a href="#" x-on:click="login = true, registrasi = false" class="underline text-green-700 text-sm mt-3">Already have an account?</a>
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