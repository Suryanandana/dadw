{{-- our services --}}
<section id="service" class="max-w-screen-xl mx-auto mt-14 scroll-mt-20 splide">
    <h2 class="py-3 font-serif text-4xl text-center">Our Services</h2>
    <div class="px-5 mx-auto splide__track">
        <ul class="splide__list">
            @foreach ($rating as $item)
            {{-- card service --}}
            <div class="p-4 md:w-1/3 splide__slide">
                <div class="h-full overflow-hidden rounded shadow-md border-opacity-60">
                    <img class="object-cover object-center w-full h-36 lg:h-48"
                        src="{{asset('storage/img/service/'.$item->imgdir)}}" alt="blog">
                    <div class="m-6">
                        <div class="">
                            <span class="text-xs font-medium tracking-widest text-gray-400 title-font">{{$item->type}} | {{$item->service_duration}} MIN</span>
                            <h3 class="text-lg font-medium text-gray-800 title-font">{{$item->service_name}}</h3>
                            <div class="flex gap-6">
                                <span class="text-green-600 text-md ">
                                    <i class="mr-1 fa-regular fa-star"></i>
                                    {{empty($item->rating) ? '-' : $item->rating}}
                                </span>
                                <ul class="list-disc">
                                    <li class="items-center text-gray-400">
                                        IDR {{ number_format($item->price, 0, '.', '.') }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <p class="mt-2 text-justify text-gray-600 line-clamp-3">
                            {{ $item->details }}
                        </p>
                        <div class="flex flex-wrap items-center justify-between text-md">
                            <a wire:navigate href="/service/{{$item->id}}"
                                class="inline-flex px-8 py-3 mt-5 text-xs tracking-widest text-white bg-green-700 border-0 rounded-sm focus:outline-none hover:bg-green-800">
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