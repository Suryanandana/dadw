<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$package->package_name}} Details</title>
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/datepicker.min.js"></script>
</head>

<body x-details="{fmodal: false, fdesc: '', ftitle: ''}">
    {{-- navbar --}}
    @extends('livewire.landing.navbar')

    {{-- service pict --}}
    <header class="2xl:h-auto 2xl:aspect-video shadow-[inset_0px_-150px_150px_-50px] shadow-stone-950 relative z-10 max-w-screen-2xl w-full top-0 2xl:left-1/2 2xl:translate-x-[-50%]">
        <!-- <div class="h-screen 2xl:aspect-video 2xl:h-auto flex justify-center"> -->
        <img src="{{asset('storage/img/service/'.$package->imgdir)}}" class="2xl:h-auto 2xl:aspect-video shadow-[inset_0px_-150px_150px_-50px] shadow-stone-950 relative z-10 max-w-screen-2xl w-full top-0 2xl:left-1/2 2xl:translate-x-[-50%]" alt="">
        <!-- </div> -->
    </header>

    

    {{-- container bawah --}}
        <div class="max-w-screen-lg mx-auto scroll-mt-20 space-y-5 px-3 text-gray-600">    
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

    {{-- deskripsi --}}        
            <h2 class="text-xs text-center text-gray-400 tracking-widest">PACKAGE DETAILS</h2>
            <h3 class="text-4xl text-center text-gray-800 tracking-wide font-serif">{{$package->package_name}}</h3>
            
            <p class="text-center leading-loose tracking-widest">{{$package->detail}}
            </p>
            <div class= "flex justify-center">
            <a href="/payment" class="px-6 py-3 text-xs text-white bg-green-700 border-0 rounded-sm focus:outline-none hover:bg-green-800 tracking-widest">Book now</a>
            </div>
        </div>

        {{-- service gallery --}}
        <h2 class="my-10 text-4xl text-center font-serif">{{$package->package_name}} Gallery</h2>
        <div class="p-1 grid sm:grid-cols-2 md:grid-cols-4 gap-1 max-w-screen-xl mx-auto">
            <img src="{{asset('img/landing/hero.webp')}}" class="rounded aspect-square object-cover">
            <img src="{{asset('img/landing/hero3.webp')}}" class="rounded aspect-square object-cover">
            <img src="{{asset('img/landing/body.webp')}}" class="rounded aspect-square object-cover">
            <img src="{{asset('img/landing/hero4.webp')}}" class="rounded aspect-square object-cover">
        </div>

        {{-- testimonial --}}
    <section class="py-14 mt-10">
        <h2 class="mb-5 text-4xl text-center font-serif">{{$package->package_name}} Testimonials</h2>
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
    </section>
    {{-- footer --}}
    @extends('livewire.landing.footer')
    <script> 
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
        new Splide( '#testimonial', detail).mount()
    </script>
</body>
</html>