@section('title', 'Payment Booking')
@section('head')
{{-- font --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
<link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@200;400;600&family=Newsreader:opsz,wght@6..72,200;6..72,300;6..72,400&display=swap"
    rel="stylesheet">
{{-- date picker --}}
<script src="https://cdn.jsdelivr.net/npm/air-datepicker@3.5.0/air-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/air-datepicker@3.5.0/air-datepicker.min.css">
<link rel="stylesheet" href="{{asset('css/date.css')}}">
{{-- collapse plugin alpine --}}
<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
{{-- flowbite js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
@endsection
@section('navbar')
    <livewire:payment-user.navbar>
@endsection
<div class="container mx-auto mt-24"
x-data="{currentStep: 3, service: true, form: false, stepper: 'Select Customer', stepperNext: 'Next: Customer Form', step: '1 of 4'}">
    {{-- stepper dekstop --}}
    <ol
        class="items-center hidden w-full text-sm font-medium text-center text-gray-500 lg:px-5 md:flex dark:text-gray-400 sm:text-base">
        <li x-bind:class="(currentStep === 1) ? 'text-green-600 dark:text-green-500' : 'text-gray-600 dark:text-gray-500'"
            class="flex md:w-full items-center sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
            <span
                class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                <svg x-show="(currentStep === 1)" class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span x-show="!(currentStep === 1)" class="me-2">1</span>
                <span class="hidden lg:inline-flex lg:ms-2 lg:mr-1">Select</span>
                Service
            </span>
        </li>
        <li x-bind:class="(currentStep === 2) ? 'text-green-600 dark:text-green-500' : 'text-gray-600 dark:text-gray-500'"
            class="flex md:w-full items-center sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
            <span
                class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                <svg x-show="(currentStep === 2)" class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span x-show="!(currentStep === 2)" class="me-2">2</span>
                <span class="hidden lg:inline-flex lg:ms-2 lg:mr-1">Booking</span>
                Date
            </span>
        </li>
        <li x-bind:class="(currentStep === 3) ? 'text-green-600 dark:text-green-500' : 'text-gray-600 dark:text-gray-500'"
            class="flex md:w-full items-center sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
            <span
                class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                <svg x-show="(currentStep === 3)" class="w-3.5 h-3.5 sm:w-4 sm:h-4 me-2.5" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span x-show="!(currentStep === 3)" class="me-2">2</span>
                <span class="hidden lg:inline-flex lg:ms-2 lg:mr-1">Customer</span>
                Form
            </span>
        </li>
        <li
            class="flex md:w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
            <span
                class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                <span class="me-2">2</span>
                Account <span class="hidden sm:inline-flex sm:ms-2">Info</span>
            </span>
        </li>
        <li class="flex items-center">
            <span class="me-2">3</span>
            Confirmation
        </li>
    </ol>
    {{-- stepper mobile --}}
    <div class="flex items-center justify-center gap-x-3 md:hidden">
        <div class="relative w-32 h-32">
            <svg class="w-full h-full" viewBox="0 0 100 100">
                <!-- Background circle -->
                <circle class="text-gray-200 stroke-current" stroke-width="10" cx="50" cy="50" r="40"
                    fill="transparent"></circle>
                <!-- Progress circle -->
                <circle class="text-green-500 stroke-current progress-ring__circle" stroke-width="10"
                    stroke-linecap="round" cx="50" cy="50" r="40" fill="transparent"
                    stroke-dashoffset="calc(400 - (400 * {{$circle}}) / 100)"></circle>
                <!-- Center text -->
                <text x="50" y="50" font-size="12" text-anchor="middle" alignment-baseline="middle"
                    class="font-semibold" x-text="step"></text>
            </svg>
        </div>
        <div class="flex flex-col">
            <span class="text-2xl font-semibold" x-text="stepper"></span>
            <span class="text-sm" x-text="stepperNext"></span>
        </div>
    </div>
    <div class="flex flex-col items-center w-full mb-10">
        <div class="relative grid items-start w-full grid-cols-1 mt-10 bg-gray-100 lg:grid-cols-2 xl:grid-cols-3">
            <livewire:payment-user.select-service>
            <livewire:payment-user.date>
            <livewire:payment-user.form-customer :customer='$customer'>
            <livewire:payment-user.verify-email>
            <livewire:payment-user.invoice lazy :customer='$customer'>
            <div wire:loading>
                <div role="status" class="absolute top-0 left-0 flex items-center justify-center w-full h-full gap-2 backdrop-blur-sm">
                    <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-green-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                    </svg>
                    <span>Loading...</span>
                </div>
            </div>
        </div>
        <livewire:payment-user.next-payment>            
    </div>
</div>
@push('scripts')
    <script src="{{asset('js/payment-user/date.js')}}"></script>
    <script src="{{asset('js/payment-user/form-customer.js')}}"></script>
@endpush