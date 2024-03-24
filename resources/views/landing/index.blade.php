<!DOCTYPE html>
<html lang="en" class="scroll-smooth select-none">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>The Cajuput Spa</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    {{-- font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
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

<body x-data="{fmodal: false, fdesc: '', ftitle: ''}">

    {{-- navbar --}}
    @include('landing.navbar')

    {{-- hero --}}
    <header class="relative z-10 max-w-screen-2xl w-full top-0 2xl:left-1/2 2xl:translate-x-[-50%]">
        <div class="flex justify-center">
            <div class="absolute z-30 top-1/2 translate-y-[-50%]">
                <h1 class="text-3xl md:text-6xl font-extrabold text-white text-center">Welcome to The Cajuput Spa</h1>
                <div class="flex gap-3 justify-center pt-5">
                    <a href="#service" class="border bg-white/25 p-3 px-6 rounded-sm text-xs font-semibold text-white text-center tracking-widest hover:cursor-pointer hover:bg-white/50">OUR SERVICES</a>
                    <a href="#" class="border bg-white/25 p-3 px-6 rounded-sm text-xs font-semibold text-white text-center tracking-widest hover:cursor-pointer hover:bg-white/50">BOOK NOW</a>
                </div>
            </div>
            <a href="#header" class="absolute bottom-4 z-30 grid justify-items-center hover:cursor-pointer">
                <span class="text-white text-xl text-center font-thin">Discover More</span>
                <svg class="h-10 w-10 text-white dark:text-white animate-bounce " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width=".6" d="m19 9-7 7-7-7"/>
                </svg>
            </a>
        </div>
        <div class="shadow-[inset_0px_-150px_150px_-50px] shadow-stone-950 h-screen 2xl:aspect-video 2xl:h-auto">
            <section id="hero" class="splide max-w-screen-2xl z-[-2]">
                <div class="splide__track h-screen 2xl:h-auto 2xl:aspect-video">
                    <ul class="splide__list max-w-screen-2xl 2xl:aspect-video">
                      <li class="splide__slide">
                          <img src="{{asset('img/landing/hero.webp')}}"  class="object-cover h-full w-full">
                      </li>
                      <li class="splide__slide">
                          <img src="{{asset('img/landing/hero2.webp')}}" class="object-cover h-full w-full">
                      </li>
                      <li class="splide__slide">
                          <img src="{{asset('img/landing/hero3.webp')}}" class="object-cover h-full w-full">
                      </li>
                      <li class="splide__slide">
                          <img src="{{asset('img/landing/hero4.webp')}}" class="object-cover h-full w-full">
                      </li>
                      <li class="splide__slide">
                          <img src="{{asset('img/landing/hero5.webp')}}" class="object-cover h-full w-full">
                      </li>
                    </ul>
                </div>
            </section>
        </div>
    </header>

    {{-- welcome message --}}
    <section id="header" class="flex items-center h-full aspect-video max-w-screen-2xl bg-green-50 mx-auto">
        <div class="max-w-screen-lg mx-auto scroll-mt-20 space-y-5 px-3 text-gray-600">
            <h2 class="text-xs text-center text-gray-400 tracking-widest">WELCOME TO THE CAJUPUT SPA</h2>
            <h3 class="text-4xl text-center text-gray-800 tracking-wide font-serif">Indulge, Relax & Rejuvenate.</h3>
            <p class="text-center leading-loose tracking-widest">At our spa, we believe in the transformative power of relaxation and self-care. Our
                dedicated team of professionals is here to provide you with a blissful escape from the everyday hustle and
                bustle.
                Immerse yourself in a world of serenity as you choose from a variety of
                luxurious treatments designed to revitalize your mind, body, and spirit. From soothing massages and
                invigorating facials to holistic wellness rituals, we offer a range of services to cater to your unique
                needs.
            </p>
                {{-- cajuput logo --}}
                <div class="flex justify-center mt-5">
                    <svg class="w-12 h-12 text-green-600/50" xmlns="http://www.w3.org/2000/svg" width="47" height="67" viewBox="0 0 47 67" fill="none">
                        <path d="M32.2534 35.0758C31.9665 28.4062 32.7362 19.9136 35.6545 16.0616C38.3446 19.351 40.1858 26.6491 40.6336 33.7301C41.1442 41.8027 40.4765 50.7097 41.0175 56.0938C35.8984 50.3284 32.5984 43.0931 32.2534 35.0758Z" fill="currentColor"/>
                        <path d="M15.0568 43.3456C15.5612 41.1027 17.8277 37.4735 19.9215 36.4858C20.4374 39.2014 20.214 42.4674 19.5212 45.4846C18.4449 49.0549 16.5138 52.5348 14.6788 54.0316C14.2252 50.2264 14.2398 46.9778 15.0568 43.3456Z" fill="currentColor"/>
                        <path d="M22.2921 43.579C21.913 33.6489 25.8593 29.1691 29.0237 25.584C28.1385 33.1697 28.2064 39.6035 28.9245 46.6622C29.7433 54.7094 30.8315 61.3839 27.8856 66.8618C27.3108 59.2897 22.821 57.435 22.2921 43.579Z" fill="currentColor"/>
                        <path d="M15.2263 33.6831C20.1419 30.5857 21.3679 28.8592 24.303 24.8994C20.0219 25.4477 16.4366 26.564 13.9915 27.9601C8.90698 30.8634 7.22337 34.6077 6.51866 39.1355C9.50152 36.2873 13.3256 34.8808 15.2263 33.6831Z" fill="currentColor"/>
                        <path d="M14.6743 14.123C9.32664 16.4918 2.05933 21.653 1.27074 26.7197C5.92812 24.4634 14.5338 23.3186 21.1314 20.4254C29.3082 16.8398 32.3821 14.1161 37.1005 11.2094C29.9544 8.88255 20.7656 11.4248 14.6743 14.123Z" fill="currentColor"/>
                    </svg>
                </div>
        </div>
    </section>
    

    {{-- our recommendation --}}
    <section>
        <h2 class="mt-14 font-serif text-4xl text-center">Special From Us</h2>
        <article class="text-gray-600 max-w-screen-xl mx-auto mt-10">
            <div class="flex flex-col gap-3 md:gap-12 items-center px-5 md:flex-row">
                <div class="basis-1/2 lg:basis-2/5">
                    <img class="w-full object-cover aspect-[4/3] rounded-sm" alt="hero" src="{{asset('img/landing/special.webp')}}">
                </div>
                <div class="basis-1/2 lg:basis-3/5 text-left">
                    <h3 class="mb-2 text-xs font-medium text-gray-400 tracking-widest">
                        SPECIAL HERE
                    </h3>
                    <h2 class="text-3xl text-gray-800 font-serif">
                        Relaxed Package
                    </h2>
                    <p class="mt-2 text-justify leading-relaxed tracking-wide">Indulge in our exclusive Cajuput Signature Rejuvenation, a harmonious
                        blend of exfoliation and hydration.
                        This treatment starts with a gentle body scrub, followed by a nourishing wrap infused with essential
                        oils derived from the Cajuput tree.
                        Surrender to the soothing ambiance as our therapists work their magic, leaving your skin revitalized
                        and your senses refreshed.</p>
                    <div class="mt-5">
                        <button class="inline-flex px-8 py-3 text-xs text-white bg-green-700 border-0 rounded-sm focus:outline-none hover:bg-green-800 tracking-widest">MORE DETAILS</button>
                    </div>
                </div>
            </div>
        </article>
        <article class="text-gray-600 max-w-screen-xl mx-auto mt-14">
            <div class="flex flex-col gap-3 md:gap-12 items-center px-5 md:flex-row-reverse">
                <div class="basis-1/2 lg:basis-2/5">
                    <img class="w-full object-cover aspect-[4/3] rounded-sm" alt="hero" src="{{asset('img/landing/body.webp')}}">
                </div>
                <div class="basis-1/2 lg:basis-3/5 text-left">
                    <h3 class="mb-2 text-xs font-medium text-gray-400 tracking-widest">
                        PEOPLE'S CHOICE
                    </h3>
                    <h2 class="text-3xl text-gray-800 font-serif">
                        Body Treatment
                    </h2>
                    <p class="mt-2 text-justify leading-relaxed tracking-wide">Indulge in our exclusive Cajuput Signature Rejuvenation, a harmonious
                        blend of exfoliation and hydration.
                        This treatment starts with a gentle body scrub, followed by a nourishing wrap infused with essential
                        oils derived from the Cajuput tree.
                        Surrender to the soothing ambiance as our therapists work their magic, leaving your skin revitalized
                        and your senses refreshed.</p>
                    <div class="mt-5">
                        <button class="inline-flex px-8 py-3 text-xs text-white bg-green-700 border-0 rounded-sm focus:outline-none hover:bg-green-800 tracking-widest">MORE DETAILS</button>
                    </div>
                </div>
            </div>
        </article>
    </section>

    {{-- Available Rooms --}}
    <section>
        <h2 class="mt-14 font-serif text-4xl text-center">Available Rooms</h2>
        <article class="text-gray-600 max-w-screen-xl mx-auto mt-10">
            <div class="flex flex-col gap-3 md:gap-12 items-center px-5 md:flex-row">
                <div class="basis-1/2 lg:basis-2/5">
                    <img class="w-full object-cover aspect-[4/3] rounded-sm" alt="hero" src="{{asset('img/landing/room1.webp')}}">
                </div>
                <div class="basis-1/2 lg:basis-3/5 text-left">
                    <h3 class="mb-2 text-xs font-medium text-gray-400 tracking-widest">
                        MAX 1 PERSON
                    </h3>
                    <h2 class="text-3xl text-gray-800 font-serif">
                        The Cave
                    </h2>
                    <p class="mt-2 text-justify leading-relaxed tracking-wide">
                        is a tranquil sanctuary within the spa, designed to immerse customers in a serene ambiance reminiscent of a natural cavern, evoking a sense of calm and relaxation through its industrial-inspired design.
                        With dim lighting and textured walls reminiscent of stone formations, "The Cave" offers a rejuvenating escape where guests can unwind and indulge in blissful tranquility amidst the soothing ambiance.
                    </p>
                    <div class="mt-5">
                        <button class="inline-flex px-8 py-3 text-xs text-white bg-green-700 border-0 rounded-sm focus:outline-none hover:bg-green-800 tracking-widest">MORE DETAILS</button>
                    </div>
                </div>
            </div>
        </article>
        <article class="text-gray-600 max-w-screen-xl mx-auto mt-14">
            <div class="flex flex-col gap-3 md:gap-12 items-center px-5 md:flex-row">
                <div class="basis-1/2 lg:basis-2/5">
                    <img class="w-full object-cover aspect-[4/3] rounded-sm" alt="hero" src="{{asset('img/landing/room2.webp')}}">
                </div>
                <div class="basis-1/2 lg:basis-3/5 text-left">
                    <h3 class="mb-2 text-xs font-medium text-gray-400 tracking-widest">
                        MAX 2 PERSON
                    </h3>
                    <h2 class="text-3xl text-gray-800 font-serif">
                        The Tropical
                    </h2>
                    <p class="mt-2 text-justify leading-relaxed tracking-wide">
                        is a blissful retreat within the spa, boasting panoramic views of lush greenery and azure waters, while its incorporation of warm wood accents creates an inviting atmosphere that transports guests to a tranquil paradise, offering a rejuvenating escape from the hustle and bustle of daily life.
                        With its vibrant foliage and earthy tones, this room exudes a sense of serenity, inviting guests to unwind and bask in the natural beauty that surrounds them, while indulging in a pampering experience that rejuvenates both body and soul.
                    </p>
                    <div class="mt-5">
                        <button class="inline-flex px-8 py-3 text-xs text-white bg-green-700 border-0 rounded-sm focus:outline-none hover:bg-green-800 tracking-widest">MORE DETAILS</button>
                    </div>
                </div>
            </div>
        </article>
    </section>

    

    {{-- our services --}}
    <section id="service" class="mt-14 scroll-mt-20 splide mx-auto max-w-screen-xl">
        <h2 class="text-4xl py-3 text-center font-serif">Our Services</h2>
        <div class="px-5 mx-auto splide__track">
            <ul class="splide__list">
                @foreach ($data as $item)
                {{-- card service --}}
                <div class="p-4 md:w-1/3 splide__slide">
                    <div class="h-full overflow-hidden shadow-md rounded border-opacity-60">
                        <img class="object-cover object-center w-full lg:h-48 md:h-36"
                            src="{{asset('img/service/'.$item->imgdir)}}" alt="blog">
                        <div class="m-6">
                            <div class="">
                                <span class="text-xs font-medium tracking-widest text-gray-400 title-font">PACKAGE | 30 MIN</span>
                                <h3 class=" text-lg font-medium text-gray-800 title-font">{{$item->service_name}}</h3>
                                <div class="flex gap-6">
                                    <button class="text-green-600 text-md "
                                        data-modal-target="default-modal-{{$item->service_name}}"
                                        data-modal-toggle="default-modal-{{$item->service_name}}">
                                        <i class="mr-1 fa-regular fa-star"></i>
                                        4.5
                                    </button>
                                    <ul class="list-disc">
                                        <li class="items-center text-gray-400">
                                            IDR {{ number_format($item->price, 0, '.', '.') }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <p class="text-gray-600 text-justify line-clamp-3">
                                {{ $item->details }}
                            </p>
                            <div class="flex flex-wrap items-center justify-between text-md">
                                <a href="/booking?service={{ $item->service_name }}"
                                    class="inline-flex mt-5 px-8 py-3 text-xs text-white bg-green-700 border-0 rounded-sm focus:outline-none hover:bg-green-800 tracking-widest">
                                    MORE DETAILS
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </ul>
        </div>
    </section>

    <!-- feedback modal -->
    @foreach ($data as $item)
    @php
    $empty = true;
    @endphp
    <div id="default-modal-{{$item->service_name}}" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 backdrop-blur-[2px] right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full p-4">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        {{$item->service_name}} Feedback
                    </h3>
                    <button type="button"
                        class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="default-modal-{{$item->service_name}}">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 space-y-4 md:p-5">

                    @foreach ($feedback as $fb)
                    @if ($fb->service_name == $item->service_name)
                    @php
                    $empty = false;
                    @endphp
                    <article>
                        <div class="flex items-center mb-4">
                            <img class="w-10 h-10 rounded-full me-4"
                                src="data:image/jpeg;base64,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"
                                alt="">
                            <div class="font-medium dark:text-white">
                                <p>{{$fb->name}} <time datetime="2014-08-16 19:00"
                                        class="block text-sm text-gray-500 dark:text-gray-400">{{date("d F Y",
                                        strtotime($fb->date))}}</time>
                                </p>
                                @if ($fb->rate == 'like')
                                <i class="text-gray-400 fa-regular fa-face-smile"></i>
                                @elseif ($fb->rate == "neutral")
                                <i class="text-gray-400 fa-regular fa-face-meh"></i>
                                @elseif ($fb->rate == "dislike")
                                <i class="text-gray-400 fa-regular fa-face-frown"></i>
                                @endif
                                <span class="text-gray-400">{{$fb->rate}}</span>
                            </div>
                        </div>
                        <p class="mb-2 text-gray-500 dark:text-gray-400">{{$fb->text}}</p>
                    </article>
                    @endif
                    @endforeach
                    @if ($empty)
                    <span>No feedback</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach

    {{-- cajuput logo --}}
    <div class="flex justify-center my-14">
        <svg class="w-12 h-12 text-green-600/50" xmlns="http://www.w3.org/2000/svg" width="47" height="67" viewBox="0 0 47 67" fill="none">
            <path d="M32.2534 35.0758C31.9665 28.4062 32.7362 19.9136 35.6545 16.0616C38.3446 19.351 40.1858 26.6491 40.6336 33.7301C41.1442 41.8027 40.4765 50.7097 41.0175 56.0938C35.8984 50.3284 32.5984 43.0931 32.2534 35.0758Z" fill="currentColor"/>
            <path d="M15.0568 43.3456C15.5612 41.1027 17.8277 37.4735 19.9215 36.4858C20.4374 39.2014 20.214 42.4674 19.5212 45.4846C18.4449 49.0549 16.5138 52.5348 14.6788 54.0316C14.2252 50.2264 14.2398 46.9778 15.0568 43.3456Z" fill="currentColor"/>
            <path d="M22.2921 43.579C21.913 33.6489 25.8593 29.1691 29.0237 25.584C28.1385 33.1697 28.2064 39.6035 28.9245 46.6622C29.7433 54.7094 30.8315 61.3839 27.8856 66.8618C27.3108 59.2897 22.821 57.435 22.2921 43.579Z" fill="currentColor"/>
            <path d="M15.2263 33.6831C20.1419 30.5857 21.3679 28.8592 24.303 24.8994C20.0219 25.4477 16.4366 26.564 13.9915 27.9601C8.90698 30.8634 7.22337 34.6077 6.51866 39.1355C9.50152 36.2873 13.3256 34.8808 15.2263 33.6831Z" fill="currentColor"/>
            <path d="M14.6743 14.123C9.32664 16.4918 2.05933 21.653 1.27074 26.7197C5.92812 24.4634 14.5338 23.3186 21.1314 20.4254C29.3082 16.8398 32.3821 14.1161 37.1005 11.2094C29.9544 8.88255 20.7656 11.4248 14.6743 14.123Z" fill="currentColor"/>
        </svg>
    </div>

    {{-- testimonial --}}
    <section class="py-14 mt-10 bg-sky-100">
        <h2 class="mb-5 text-4xl text-center font-serif">What People Think?</h2>
        <div id="testimonial" class="splide mx-auto max-w-screen-xl">
            <div class="splide__track p-5 h-content">
                <ul class="splide__list">
                    <li class="splide__slide">
                        {{-- card --}}
                        <div class="grid gap-3 mx-3 p-5 bg-white rounded-lg">
                            <div class="flex items-start justify-between gap-2">
                                <div class="flex flex-wrap items-center gap-3">
                                    {{-- profile pic --}}
                                    <div class="text-green-600 border border-green-600 bg-green-200 rounded-full size-12">
                                        <svg class="size-10 mx-auto text-green-600" xmlns="http://www.w3.org/2000/svg" width="47" height="67" viewBox="0 0 47 67" fill="none">
                                            <path d="M32.2534 35.0758C31.9665 28.4062 32.7362 19.9136 35.6545 16.0616C38.3446 19.351 40.1858 26.6491 40.6336 33.7301C41.1442 41.8027 40.4765 50.7097 41.0175 56.0938C35.8984 50.3284 32.5984 43.0931 32.2534 35.0758Z" fill="currentColor"/>
                                            <path d="M15.0568 43.3456C15.5612 41.1027 17.8277 37.4735 19.9215 36.4858C20.4374 39.2014 20.214 42.4674 19.5212 45.4846C18.4449 49.0549 16.5138 52.5348 14.6788 54.0316C14.2252 50.2264 14.2398 46.9778 15.0568 43.3456Z" fill="currentColor"/>
                                            <path d="M22.2921 43.579C21.913 33.6489 25.8593 29.1691 29.0237 25.584C28.1385 33.1697 28.2064 39.6035 28.9245 46.6622C29.7433 54.7094 30.8315 61.3839 27.8856 66.8618C27.3108 59.2897 22.821 57.435 22.2921 43.579Z" fill="currentColor"/>
                                            <path d="M15.2263 33.6831C20.1419 30.5857 21.3679 28.8592 24.303 24.8994C20.0219 25.4477 16.4366 26.564 13.9915 27.9601C8.90698 30.8634 7.22337 34.6077 6.51866 39.1355C9.50152 36.2873 13.3256 34.8808 15.2263 33.6831Z" fill="currentColor"/>
                                            <path d="M14.6743 14.123C9.32664 16.4918 2.05933 21.653 1.27074 26.7197C5.92812 24.4634 14.5338 23.3186 21.1314 20.4254C29.3082 16.8398 32.3821 14.1161 37.1005 11.2094C29.9544 8.88255 20.7656 11.4248 14.6743 14.123Z" fill="currentColor"/>
                                        </svg>
                                    </div>
                                    {{-- detail --}}
                                    <div class="flex flex-col justify-center text-xs">
                                        <span class="text-sm font-semibold text-gray-800">Ariana Kjelberg</span>
                                        <span class="text-gray-500">27 Oct 2023</span>
                                        <span class="text-gray-400 truncate">
                                            Hair Treatment | Room 2
                                        </span>
                                    </div>
                                </div>
                                {{-- score --}}
                                <div class="flex items-end justify-center">
                                    <span class="text-4xl text-green-500 font-extrabold">
                                        4
                                    </span>
                                    <span class="text-gray-400 font-semibold">/5</span>
                                </div>
                            </div>
                            {{-- comment --}}
                            <div>
                                <span class="font-semibold">
                                    Awesome Works!
                                </span>
                                <p class="text-gray-500 text-sm tracking-wide">
                                    The Luxurious Scalp Renewal at The Cajuput Spa is a must-try. The scalp massage was so relaxing, and the treatment left my scalp feeling rejuvenated. My hair has never looked healthier. A truly pampering experience that I'll be coming back for regularly!
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="grid gap-3 mx-3 p-5 bg-white rounded-lg">
                            <div class="flex items-start justify-between gap-2">
                                <div class="flex flex-wrap items-center gap-3">
                                    {{-- profile pic --}}
                                    <div class="text-green-600 border border-green-600 bg-green-200 rounded-full size-12">
                                        <svg class="size-10 mx-auto text-green-600" xmlns="http://www.w3.org/2000/svg" width="47" height="67" viewBox="0 0 47 67" fill="none">
                                            <path d="M32.2534 35.0758C31.9665 28.4062 32.7362 19.9136 35.6545 16.0616C38.3446 19.351 40.1858 26.6491 40.6336 33.7301C41.1442 41.8027 40.4765 50.7097 41.0175 56.0938C35.8984 50.3284 32.5984 43.0931 32.2534 35.0758Z" fill="currentColor"/>
                                            <path d="M15.0568 43.3456C15.5612 41.1027 17.8277 37.4735 19.9215 36.4858C20.4374 39.2014 20.214 42.4674 19.5212 45.4846C18.4449 49.0549 16.5138 52.5348 14.6788 54.0316C14.2252 50.2264 14.2398 46.9778 15.0568 43.3456Z" fill="currentColor"/>
                                            <path d="M22.2921 43.579C21.913 33.6489 25.8593 29.1691 29.0237 25.584C28.1385 33.1697 28.2064 39.6035 28.9245 46.6622C29.7433 54.7094 30.8315 61.3839 27.8856 66.8618C27.3108 59.2897 22.821 57.435 22.2921 43.579Z" fill="currentColor"/>
                                            <path d="M15.2263 33.6831C20.1419 30.5857 21.3679 28.8592 24.303 24.8994C20.0219 25.4477 16.4366 26.564 13.9915 27.9601C8.90698 30.8634 7.22337 34.6077 6.51866 39.1355C9.50152 36.2873 13.3256 34.8808 15.2263 33.6831Z" fill="currentColor"/>
                                            <path d="M14.6743 14.123C9.32664 16.4918 2.05933 21.653 1.27074 26.7197C5.92812 24.4634 14.5338 23.3186 21.1314 20.4254C29.3082 16.8398 32.3821 14.1161 37.1005 11.2094C29.9544 8.88255 20.7656 11.4248 14.6743 14.123Z" fill="currentColor"/>
                                        </svg>
                                    </div>
                                    {{-- detail --}}
                                    <div class="flex flex-col justify-center text-xs">
                                        <span class="text-sm font-semibold text-gray-800">Mayrika Diva</span>
                                        <span class="text-gray-500">27 Oct 2023</span>
                                        <span class="text-gray-400 truncate">
                                            Body Treatment | Room 1
                                        </span>
                                    </div>
                                </div>
                                {{-- score --}}
                                <div class="flex items-end justify-center">
                                    <span class="text-4xl text-green-500 font-extrabold">
                                        5
                                    </span>
                                    <span class="text-gray-400 font-semibold">/5</span>
                                </div>
                            </div>
                            {{-- comment --}}
                            <div>
                                <span class="font-semibold">
                                    Great Feelings!
                                </span>
                                <p class="text-gray-500 text-sm tracking-wide">
                                    The body treatment services are a true escape to serenity. The tailored approach and luxurious ambiance elevate the experience. From soothing wraps to invigorating scrubs, each session is a journey to relaxation and radiant well-being. A must-try for anyone seeking ultimate pampering!
                                </p>
                            </div>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="grid gap-3 mx-3 p-5 bg-white rounded-lg">
                            <div class="flex items-start justify-between gap-2">
                                <div class="flex flex-wrap items-center gap-3">
                                    {{-- profile pic --}}
                                    <div class="text-green-600 border border-green-600 bg-green-200 rounded-full size-12">
                                        <svg class="size-10 mx-auto text-green-600" xmlns="http://www.w3.org/2000/svg" width="47" height="67" viewBox="0 0 47 67" fill="none">
                                            <path d="M32.2534 35.0758C31.9665 28.4062 32.7362 19.9136 35.6545 16.0616C38.3446 19.351 40.1858 26.6491 40.6336 33.7301C41.1442 41.8027 40.4765 50.7097 41.0175 56.0938C35.8984 50.3284 32.5984 43.0931 32.2534 35.0758Z" fill="currentColor"/>
                                            <path d="M15.0568 43.3456C15.5612 41.1027 17.8277 37.4735 19.9215 36.4858C20.4374 39.2014 20.214 42.4674 19.5212 45.4846C18.4449 49.0549 16.5138 52.5348 14.6788 54.0316C14.2252 50.2264 14.2398 46.9778 15.0568 43.3456Z" fill="currentColor"/>
                                            <path d="M22.2921 43.579C21.913 33.6489 25.8593 29.1691 29.0237 25.584C28.1385 33.1697 28.2064 39.6035 28.9245 46.6622C29.7433 54.7094 30.8315 61.3839 27.8856 66.8618C27.3108 59.2897 22.821 57.435 22.2921 43.579Z" fill="currentColor"/>
                                            <path d="M15.2263 33.6831C20.1419 30.5857 21.3679 28.8592 24.303 24.8994C20.0219 25.4477 16.4366 26.564 13.9915 27.9601C8.90698 30.8634 7.22337 34.6077 6.51866 39.1355C9.50152 36.2873 13.3256 34.8808 15.2263 33.6831Z" fill="currentColor"/>
                                            <path d="M14.6743 14.123C9.32664 16.4918 2.05933 21.653 1.27074 26.7197C5.92812 24.4634 14.5338 23.3186 21.1314 20.4254C29.3082 16.8398 32.3821 14.1161 37.1005 11.2094C29.9544 8.88255 20.7656 11.4248 14.6743 14.123Z" fill="currentColor"/>
                                        </svg>
                                    </div>
                                    {{-- detail --}}
                                    <div class="flex flex-col justify-center text-xs">
                                        <span class="text-sm font-semibold text-gray-800">Richard Velix</span>
                                        <span class="text-gray-500">27 Oct 2023</span>
                                        <span class="text-gray-400 truncate">
                                            Body Messages | Room 1
                                        </span>
                                    </div>
                                </div>
                                {{-- score --}}
                                <div class="flex items-end justify-center">
                                    <span class="text-4xl text-green-500 font-extrabold">
                                        5
                                    </span>
                                    <span class="text-gray-400 font-semibold">/5</span>
                                </div>
                            </div>
                            {{-- comment --}}
                            <div>
                                <span class="font-semibold">
                                    The Best Spa in Bali
                                </span>
                                <p class="text-gray-500 text-sm tracking-wide">
                                    The massage services at The Cajuput Spa are pure bliss! The therapist's skilled touch and the tranquil ambiance create an unparalleled relaxation experience. It's a sanctuary for rejuvenation I left feeling utterly refreshed. Highly recommended!
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        {{-- gallery --}}
        <h2 class="my-10 text-4xl text-center font-serif">The Cajuput Gallery</h2>
        <div class="p-1 grid sm:grid-cols-2 md:grid-cols-4 gap-1 max-w-screen-xl mx-auto">
            <img src="{{asset('img/landing/hero.webp')}}" class="rounded aspect-square object-cover">
            <img src="{{asset('img/landing/hero2.webp')}}" class="rounded aspect-square object-cover">
            <img src="{{asset('img/landing/room1.webp')}}" class="rounded aspect-square object-cover">
            <img src="{{asset('img/landing/hero3.webp')}}" class="rounded aspect-square object-cover">
            <img src="{{asset('img/landing/body.webp')}}" class="rounded aspect-square object-cover">
            <img src="{{asset('img/landing/hero4.webp')}}" class="rounded aspect-square object-cover">
            <img src="{{asset('img/landing/room2.webp')}}" class="rounded aspect-square object-cover">
            <img src="{{asset('img/landing/special.webp')}}" class="rounded aspect-square object-cover">
        </div>
    </section>


    {{-- chat --}}
    @auth
    @if (Auth::user()->level == 'customer')
    <livewire:chat />
    @endif
    @endauth
    @guest
    <div x-data="{show: false}">
        <div x-on:click="show = true" class="fixed z-50 p-2 bg-green-700/70 hover:bg-green-700 rounded-full cursor-pointer right-5 bottom-5">
            <svg class="w-10 h-10 text-gray-100 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M14.079 6.839a3 3 0 0 0-4.255.1M13 20h1.083A3.916 3.916 0 0 0 18 16.083V9A6 6 0 1 0 6 9v7m7 4v-1a1 1 0 0 0-1-1h-1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1Zm-7-4v-6H5a2 2 0 0 0-2 2v2a2 2 0 0 0 2 2h1Zm12-6h1a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-1v-6Z" />
            </svg>
        </div>
        <div x-cloak x-show="show" @click.away="show = false"
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

    {{-- navigation and contact --}}
    <section class="flex md:flex-row flex-col gap-10 px-10 mt-16 text-sm">
        <div class="basis-1/5 space-y-3">
            <span class="font-semibold">Sitemap</span>
            <ul class="ml-2 list-disc list-outside space-y-3 columns-2 sm:columns-3 md:columns-1">
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
        <div class="flex flex-col basis-1/2">
            <label for="message" class="block font-semibold text-gray-900 dark:text-white">Contact</label>
            <span class="text-gray-500">(0361) 771234 </span>
            <span class="text-gray-500">(+62) 81 99191 9919</span>

            <label for="message" class="block mt-4 font-semibold text-gray-900 dark:text-white">Reach Us</label>
            <input type="text" id="first_name"
                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-sm focus:outline-none focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Your email address" required>
            <textarea id="message" rows="4"
                class="block p-2.5 my-3 w-full text-gray-900 bg-gray-50 rounded-sm border border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Message"></textarea>
            <button type="button" class="text-white w-fit bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 rounded-sm text-xs tracking-widest px-5 py-2.5 text-center mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">SEND</button>
        </div>
        <div class="flex flex-col basis-2/5">
            <span class="font-semibold">Find Us</span>
            <span class="mb-4 text-gray-500">Lorem St. No. 20 Ipsum, Dolor del Amet, Laddowashinghton AC, 810280</span>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1737.6221882978507!2d-98.48650795000005!3d29.421653200000023!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x865c58aa57e6a56f%3A0xf08a9ad66f03e879!2sHenry+B.+Gonzalez+Convention+Center!5e0!3m2!1sen!2sus!4v1393884854786"
                height="250" frameborder="0" style="border:0"></iframe>
        </div>
    </section>

    {{-- footer --}}
    @include('landing.footer')

    <script>
        // splide config
        var detail = {
            perPage: 3,
            perMove: 1,
            drag: true,
            pagination: false,
            type: 'loop',
            breakpoints: {
                640: {
                    perPage: 1,
                },
                1024: {
                    perPage: 2,
                }
            }
        }
        
        new Splide( '#service', detail).mount()
        new Splide( '#testimonial', detail).mount() 

        new Splide('#hero', {
            type: 'fade',
            autoplay: true,
            interval: 8000,
            speed: 2000,
            rewind: true,
            pagination : false,
            arrows: false,
            breakpoints: {
            }
        }).mount();
        
        // dynamic navbar background
        document.addEventListener("DOMContentLoaded", function() {
            window.addEventListener("scroll", function() {
                var height = document.getElementById('nav-container').offsetHeight;
                var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                list = document.querySelectorAll('[id=nav-text]')

                if (scrollTop >= height - 40) {
                    document.getElementById('nav-container').classList.add('md:animate-fadein');
                    document.getElementById('nav-container').classList.remove('md:animate-fadeout');
                    document.getElementById('logo').classList.add('md:animate-textfadein');
                    document.getElementById('logo').classList.remove('md:animate-textfadeout');
                    document.getElementById('nav-list').classList.add('md:animate-textfadein');
                    document.getElementById('nav-list').classList.remove('md:animate-textfadeout');
                } else {
                    document.getElementById('nav-container').classList.add('md:animate-fadeout');
                    document.getElementById('nav-container').classList.remove('md:animate-fadein');
                    document.getElementById('logo').classList.add('md:animate-textfadeout');
                    document.getElementById('logo').classList.remove('md:animate-textfadein');
                    document.getElementById('nav-list').classList.remove('md:animate-textfadein');
                    document.getElementById('nav-list').classList.add('md:animate-textfadeout');
                }
            })
        }); 
    </script>
</body>

</html>