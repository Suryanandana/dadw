var today = new Date();
today.setHours(9, 0, 0, 0);
today.setMinutes(0)
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
    timepicker: true,
    minHours: 9,
    maxHours: 20,
    minutesStep: 30,
    startDate: today,
    minDate : today,
    maxDate : new Date().setMonth(new Date().getMonth() + 3),
    onSelect(date) {
        let selectedDate = new Date(date.date);
        let formattedDate = selectedDate.getDate() + ' ' + selectedDate.toLocaleString('default', { month: 'long' }) + ', ' + selectedDate.getFullYear() + '. ' + String(selectedDate.getHours()).padStart(2, '0') + ':' + String(selectedDate.getMinutes()).padStart(2, '0') + ' WITA';
        let formattedDateInput = selectedDate.getDate() + '-' + selectedDate.getMonth() + '-' + selectedDate.getFullYear();
        date.formattedDate = formattedDate;
        if (date.date === undefined) {
            formattedDate = '-';
            formattedDateInput = '';
        }
        window.Livewire.dispatch('date', {date: formattedDateInput})
        window.Livewire.dispatch('format-date', {date: formattedDate})
    }
});