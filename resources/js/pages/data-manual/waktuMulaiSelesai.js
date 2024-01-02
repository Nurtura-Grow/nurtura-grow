import $ from 'jquery';
import flatpickr from "flatpickr";
import moment from "moment";
import tz from "moment-timezone";

// Get current date and hour
var currentHour = moment().tz('Asia/Jakarta').format('HH:mm');

// Menyesuaikan satuan volume
const satuan = document.getElementById('satuan');
const volume = document.getElementById('volume');

// Debit air (liter/menit)
let nilaiVolumeLiter, nilaiSatuan, minutes;
const debit = 7;

var options = {
    enableTime: true,
    noCalendar: true,
    enableSeconds: false,
    dateFormat: "H:i",
    minuteIncrement: 1,
    allowInput: false,
    time_24hr: true,
    minTime: currentHour,
}

var startTime = null;
var endTime = null;

// Initialize the waktu-selesai flatpickr
var waktuSelesaiPicker = flatpickr(".waktu-selesai", {
    ...options,
    onChange: function (selectedDates) {
        endTime = selectedDates[0];
        calculateDuration();
    },
});

// Initialize the waktu-mulai flatpickr
var waktuMulaiPicker = flatpickr(".waktu-mulai", {
    ...options,
    onChange: function (selectedDates) {
        // Get the selected time
        startTime = selectedDates[0];

        // Calculate time 3 hours ahead
        var maxTime = new Date(startTime.getTime() + 3 * 60 * 60 * 1000);


        if (startTime) {
            // Set the minimum time for waktu-selesai to the selected time of waktu-mulai
            waktuSelesaiPicker.set('minTime', startTime);
            waktuSelesaiPicker.set('maxTime', maxTime);
        }

        startTime = new Date(startTime.getTime());
        calculateDuration();
    }
});

function calculateDuration() {
    if (startTime && endTime) {
        console.log("calculateDuration startTime", startTime)
        console.log("calculateDuration endTime", endTime)

        // Calculate the difference in milliseconds
        var durationMillis = endTime - startTime;

        console.log("calculateDuration durationMillis", durationMillis)

        // Convert milliseconds to hours and minutes
        minutes = Math.floor(durationMillis / (1000 * 60));

        // Check if the duration is negative or more than 3 hours
        if (durationMillis <= 0 || (minutes > 180)) {
            $('#submit').prop('disabled', true);
        } else {
            $('#submit').prop('disabled', false);
        }

        // Display or return the duration
        $('#durasi').val(minutes + " menit");

        // Update Waktu selesai
        $('.waktu-selesai').val(moment(endTime, 'HH:mm').format('HH:mm'))

        // Update volume
        nilaiVolumeLiter = minutes * debit;
        if (nilaiSatuan == "mL") {
            volume.value = nilaiVolumeLiter * 1000;
        } else {
            volume.value = nilaiVolumeLiter;
        }
    } else {
        $('#durasi').val("Pilih waktu mulai dan selesai untuk mendapatkan durasi");
        $('#submit').prop('disabled', true);
    }
}

if (satuan && volume) {
    satuan.addEventListener('change', function () {
        nilaiSatuan = satuan.value
        if (nilaiSatuan == "mL") {
            nilaiVolumeLiter = volume.value;
            volume.value *= 1000;
        } else if (nilaiSatuan == "L") {
            volume.value /= 1000;
        }

        getTimeMinute();
    })

    volume.addEventListener('change', function () {
        nilaiVolumeLiter = volume.value;
        if (nilaiSatuan == "mL") {
            nilaiVolumeLiter = volume.value / 1000;
        }

        console.log('volumeChange', nilaiVolumeLiter)

        nilaiSatuan = satuan.value;
        getTimeMinute();
    })

    const getTimeMinute = () => {
        const timeMinute = nilaiVolumeLiter / debit;

        // Update waktu-mulai and waktu-selesai value
        if (!startTime) {
            startTime = moment(currentHour, 'HH:mm');
        } else {
            startTime = moment(startTime, 'HH:mm')
        }

        endTime = moment(startTime, 'HH:mm').add(timeMinute, 'minutes')
        console.log('getTimeMinute endTime', endTime)

        $('.waktu-mulai').val(moment(startTime, 'HH:mm').format('HH:mm'))
        $('.waktu-selesai').val(moment(endTime, 'HH:mm').format('HH:mm'))

        calculateDuration();
    }
}
