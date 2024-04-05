<header id="heroes" class="relative z-10 max-w-screen-2xl w-full top-0 2xl:left-1/2 2xl:translate-x-[-50%]">
    <div class="flex justify-center">
        <div class="absolute z-30 top-1/2 translate-y-[-50%]">
            <h1 class="text-3xl font-extrabold text-center text-white md:text-6xl">Welcome to The Cajuput Spa</h1>
            <div class="flex justify-center gap-3 pt-5">
                <a href="#service"
                    class="p-3 px-6 text-xs font-semibold tracking-widest text-center text-white border rounded-sm bg-white/25 hover:cursor-pointer hover:bg-white/50">OUR
                    SERVICES</a>
                <a href="/payment" wire:navigate
                    class="p-3 px-6 text-xs font-semibold tracking-widest text-center text-white border rounded-sm bg-white/25 hover:cursor-pointer hover:bg-white/50">BOOK
                    NOW</a>
            </div>
        </div>
        <a href="#header" class="absolute z-30 grid bottom-4 justify-items-center hover:cursor-pointer">
            <span class="text-xl font-thin text-center text-white">Discover More</span>
            <svg class="w-10 h-10 text-white dark:text-white animate-bounce " aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width=".6"
                    d="m19 9-7 7-7-7" />
            </svg>
        </a>
    </div>
    <div class="shadow-[inset_0px_-150px_150px_-50px] shadow-stone-950 h-screen 2xl:aspect-video 2xl:h-auto">
        <section id="hero" class="splide max-w-screen-2xl z-[-2]">
            <div class="h-screen splide__track 2xl:h-auto 2xl:aspect-video">
                <ul class="splide__list max-w-screen-2xl 2xl:aspect-video">
                    <li class="splide__slide">
                        <img src="{{asset('img/landing/hero.webp')}}" class="object-cover w-full h-full">
                    </li>
                    <li class="splide__slide">
                        <img src="{{asset('img/landing/hero2.webp')}}" class="object-cover w-full h-full">
                    </li>
                    <li class="splide__slide">
                        <img src="{{asset('img/landing/hero3.webp')}}" class="object-cover w-full h-full">
                    </li>
                    <li class="splide__slide">
                        <img src="{{asset('img/landing/hero4.webp')}}" class="object-cover w-full h-full">
                    </li>
                    <li class="splide__slide">
                        <img src="{{asset('img/landing/hero5.webp')}}" class="object-cover w-full h-full">
                    </li>
                </ul>
            </div>
        </section>
    </div>
</header>