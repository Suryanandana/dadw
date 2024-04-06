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
{{-- collapse plugin alpine --}}
<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
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
        <div class="grid items-start w-full grid-cols-1 mt-10 bg-gray-100 lg:grid-cols-2 xl:grid-cols-3">
            <livewire:payment-user.select-service>
            <livewire:payment-user.date>
            <livewire:payment-user.form-customer>
            <livewire:payment-user.invoice lazy>
        </div>
        <livewire:payment-user.next-payment>
    </div>
</div>
@push('scripts')
    <script src="{{asset('js/payment-user/date.js')}}"></script>
    <script src="{{asset('js/payment-user/form-customer.js')}}"></script>
@endpush