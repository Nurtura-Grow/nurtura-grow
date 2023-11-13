import Litepicker from 'litepicker';
import 'litepicker/dist/plugins/mobilefriendly';
import moment from 'moment';

var customOptions = {
    autoApply: false,
    singleMode: true,
    numberOfColumns: 1,
    numberOfMonths: 1,
    showWeekNumbers: false,
    format: "DD MMM YYYY",
    plugins: ['mobilefriendly'], // Plugins -> mobilefriendly: can swipe on mobile
    dropdowns: {
        minYear: 2000,
        maxYear: null,
        months: true,
        years: true
    }
};

// Get Current Date
const formattedDate = moment().format('DD MMM YYYY')

// Change Default Value
function setDefaultValue(element, daysToAdd = 0) {
    const defaultDate = moment().add(daysToAdd, 'days').format('DD MMM YYYY');
    if (!element.value) {
        element.value = defaultDate;
    }
}

// Change Default Value
const dateMulaiTanam = document.getElementById("dateMulaiTanam");
const dateSelesaiTanam = document.getElementById("dateSelesaiTanam");
setDefaultValue(dateMulaiTanam);
setDefaultValue(dateSelesaiTanam, 60);

// Create Litepicker Element
const pickerMulaiTanam = new Litepicker({
    element: dateMulaiTanam,
    ...customOptions
})
const pickerSelesaiTanam = new Litepicker({
    element: dateSelesaiTanam,
    ...customOptions,
    minDate: formattedDate
})

// Change Value for Selesai Tanam (can't apply date before mulai tanam)
pickerMulaiTanam.on('button:apply', (date) => {
    // Todo: add default value + 60 if the mulai tanam is changed
    if (!dateSelesaiTanam.value) {
        pickerSelesaiTanam.setOptions({
            startDate: date,
        })
    }

    pickerSelesaiTanam.setOptions({
        minDate: date,
        setDate: futureDate
    })
})

pickerSelesaiTanam.on('button:apply', (date) => {
    if (!dateMulaiTanam.value) {
        pickerMulaiTanam.setOptions({
            endDate: date
        })
    }

    pickerMulaiTanam.setOptions({
        maxDate: date
    })
})
