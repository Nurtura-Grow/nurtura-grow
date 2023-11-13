import $ from 'jquery';
import flatpickr from "flatpickr";

$(document).ready(function () {
    var options = {
        enableTime: true,
        noCalendar: true,
        enableSeconds: true,
        dateFormat: "H:i:S K",
        minuteIncrement: 1,
        allowInput: true
    }
    flatpickr(".waktu-mulai", options);
    flatpickr(".waktu-selesai", options);
});

