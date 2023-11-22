import moment from "moment";
import Litepicker from 'litepicker';
import 'litepicker/dist/plugins/mobilefriendly';

const today = moment().format('DD MMM YYYY');

// Get Current Date
var customOptions = {
    autoApply: false,
    singleMode: true,
    numberOfColumns: 1,
    numberOfMonths: 1,
    showWeekNumbers: false,
    format: "DD MMM YYYY",
    maxDate: today,
    plugins: ['mobilefriendly'], // Plugins -> mobilefriendly: can swipe on mobile
    dropdowns: {
        minYear: 2000,
        maxYear: null,
        months: true,
        years: true
    }
};

// Change Default Value
const tanggal_dari = document.getElementById("tanggal_dari");
const tanggal_hingga = document.getElementById("tanggal_hingga");

setDefaultValue(tanggal_dari);
setDefaultValue(tanggal_hingga);

function setDefaultValue(element) {
    if (!element.value) {
        element.value = today;
    }
}

const pickerTanggalDari = new Litepicker({
    element: tanggal_dari,
    ...customOptions
})

const pickerTanggalHingga = new Litepicker({
    element: tanggal_hingga,
    ...customOptions,
    minDate: today,
})

pickerTanggalDari.on('button:apply', (date) => {
    pickerTanggalHingga.setOptions({
        minDate: date,
    })
})
