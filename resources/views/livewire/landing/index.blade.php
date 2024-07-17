@section('title', 'The Cajuput Spa')

@section('head')
{{-- font --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
<link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@200;400;600&family=Newsreader:opsz,wght@6..72,200;6..72,300;6..72,400&display=swap"
    rel="stylesheet">
{{-- flowbite js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
{{-- font awesome --}}
<script src="https://kit.fontawesome.com/7eaa0f0932.js" crossorigin="anonymous"></script>
{{-- splide --}}
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
@endsection

@section('navbar')
    <livewire:landing.navbar>
@endsection

<main>
    <livewire:landing.hero>
    <livewire:landing.welcome>
    <livewire:landing.recommendation>
    <livewire:landing.logo>
    <livewire:landing.rooms>
    <livewire:landing.logo>
    <livewire:landing.services>
    <livewire:landing.logo>
    <livewire:landing.testimonial>
    <livewire:landing.chat>
    <livewire:landing.contact>
    <livewire:landing.footer>
</main>

@push('scripts')
<script src="{{asset('js/landing/splide.js')}}"></script>
<script src="{{asset('js/landing/navbar.js')}}"></script>
@endpush