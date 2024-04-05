@section('title')
    Liv
@endsection
@section('navbar')
    @livewire('next-payment')
@endsection
<div class="w-full p-3 bg-white">
    {{-- Care about people's approval and you will be their prisoner. --}}
    <a href="/livewire" wire:navigate>adbhabhdab</a>
</div>
<script src="
https://cdn.jsdelivr.net/npm/air-datepicker@3.5.0/air-datepicker.min.js
"></script>
<script>
    // Dapatkan tanggal hari ini
    var today = new Date();
    // Atur jam ke 9 pagi
    today.setHours(9);
    today.setMinutes(0);
    today.setSeconds(0);
    // maxDate today + 3 bulan
    maxDate = new Date();
    maxDate.setMonth(maxDate.getMonth() + 3);
    // Inisialisasi AirDatepicker

    new AirDatepicker('#date', {
        locale: {days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
                daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                months: ['January','February','March','April','May','June', 'July','August','September','October','November','December'],
                monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                dateFormat: 'dd/MM/yyyy',
            },
        startDate: today,
        minDate: today,
        maxDate: maxDate,
    })
</script>