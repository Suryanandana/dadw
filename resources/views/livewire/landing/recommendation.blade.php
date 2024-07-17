{{-- our recommendation --}}
<section>
    <h2 class="font-serif text-4xl text-center mt-14">Special From Us</h2>
    <article class="max-w-screen-xl mx-auto mt-10 text-gray-600">
        <div class="flex flex-col items-center gap-3 px-5 md:gap-12 md:flex-row">
            <div class="basis-1/2 lg:basis-2/5">
                <img class="w-full object-cover aspect-[4/3] rounded-sm" alt="hero" src="/storage/img/service/{{$dataPack[4]->imgdir}}">
            </div>
            <div class="text-left basis-1/2 lg:basis-3/5">
                <h3 class="mb-2 text-xs font-medium tracking-widest text-gray-400">SPECIAL HERE</h3>
                <h2 class="font-serif text-3xl text-gray-800">{{$dataPack[4]->service_name}}</h2>
                <p class="mt-2 leading-relaxed tracking-wide text-justify">{{$dataPack[4]->details}}</p>
                <div class="mt-5">
                    <a href="/service/{{$dataPack[4]->id}}" class="inline-flex px-8 py-3 text-xs tracking-widest text-white bg-green-700 border-0 rounded-sm focus:outline-none hover:bg-green-800">MORE DETAILS</a>
                </div>
            </div>
        </div>
    </article>
    <article class="max-w-screen-xl mx-auto text-gray-600 mt-14">
        <div class="flex flex-col items-center gap-3 px-5 md:gap-12 md:flex-row-reverse">
            <div class="basis-1/2 lg:basis-2/5">
                <img class="w-full object-cover aspect-[4/3] rounded-sm" alt="hero" src="/storage/img/service/{{$dataPack[0]->imgdir}}">
            </div>
            <div class="text-left basis-1/2 lg:basis-3/5">
                <h3 class="mb-2 text-xs font-medium tracking-widest text-gray-400">PEOPLE'S CHOICE</h3>
                <h2 class="font-serif text-3xl text-gray-800">{{$dataPack[0]->service_name}}</h2>
                <p class="mt-2 leading-relaxed tracking-wide text-justify">{{$dataPack[0]->details}}</p>
                <div class="mt-5">
                    <button wire:navigate href="/service/{{$dataPack[0]->id}}" class="inline-flex px-8 py-3 text-xs tracking-widest text-white bg-green-700 border-0 rounded-sm focus:outline-none hover:bg-green-800">MORE DETAILS</button>
                </div>
            </div>
        </div>
    </article>
</section>