var datepicker = new AirDatepicker('#date', {
    locale: {
        days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
        daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
        months: ['January','February','March','April','May','June', 'July','August','September','October','November','December'],
        monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        today: 'Today',
        clear: 'Clear',
        firstDay: 0
    },
    minDate : new Date(),
    maxDate : new Date().setMonth(new Date().getMonth() + 3),
    onSelect(date) {
        let selectedDate = new Date(date.date);
        let formattedDate = selectedDate.getDate() + ' ' + selectedDate.toLocaleString('default', { month: 'long' }) + ', ' + selectedDate.getFullYear();
        let formattedDateInput = selectedDate.getDate() + '-' + selectedDate.getMonth() + '-' + selectedDate.getFullYear();
        date.formattedDate = formattedDate;
        if (date.date === undefined) {
            formattedDate = '-';
            formattedDateInput = '';
        }
        window.Livewire.dispatch('date', {date: formattedDateInput})
        document.getElementById('date-invoice').innerText = formattedDate;
    }
});