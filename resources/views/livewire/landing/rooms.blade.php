{{-- Available Rooms --}}
<section>
    <h2 class="font-serif text-4xl text-center mt-14">Available Rooms</h2>
    @foreach($data as $item)
    <article class="max-w-screen-xl mx-auto mt-10 text-gray-600">
        <div class="flex flex-col items-center gap-3 px-5 md:gap-12 md:flex-row">
            <div class="basis-1/2 lg:basis-2/5">
                <img class="w-full object-cover aspect-[4/3] rounded-sm" alt="hero" src="{{asset('img/landing/'.$item->imgdir)}}">
            </div>
            <div class="text-left basis-1/2 lg:basis-3/5">
                <h3 class="mb-2 text-xs font-medium tracking-widest text-gray-400">
                {{ $item->category }}
                </h3>
                <h2 class="font-serif text-3xl text-gray-800">
                {{ $item->room_name }}
                </h2>
                <p class="mt-2 leading-relaxed tracking-wide text-justify">
                {{ $item->description }}
                </p>
                <div class="mt-5">
                    <a href="{{ route('rooms.detail', ['id' => $item->id]) }}" class="inline-flex px-8 py-3 text-xs tracking-widest text-white bg-green-700 border-0 rounded-sm focus:outline-none hover:bg-green-800">
                        MORE DETAILS
                    </a>
                </div>
            </div>
        </div>
    </article>
    @endforeach
</section>