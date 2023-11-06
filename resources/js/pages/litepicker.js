import Litepicker from 'litepicker';
import 'litepicker/dist/plugins/mobilefriendly';
import moment from 'moment';

var customOptions = {
    autoApply: false,
    singleMode: true,
    numberOfColumns: 1,
    numberOfMonths: 1,
    showWeekNumbers: false,
    format: "DD MMM, YYYY",
    plugins: ['mobilefriendly'],
    dropdowns: {
        minYear: 2000,
        maxYear: null,
        months: true,
        years: true
    }
};

const formattedDate = moment().format('DD MMM, YYYY')
const dateMulaiTanam = document.getElementById("dateMulaiTanam");
const dateSelesaiTanam = document.getElementById("dateSelesaiTanam");

if(! dateMulaiTanam.value){
    dateMulaiTanam.value = formattedDate;
}

if( !dateSelesaiTanam.value){
    dateSelesaiTanam.value = formattedDate;
}

const pickerMulaiTanam = new Litepicker({
    element: dateMulaiTanam,
    ...customOptions
})
const pickerSelesaiTanam = new Litepicker({
    element: dateSelesaiTanam,
    ...customOptions
})

pickerMulaiTanam.on('button:apply', (date) => {
    if (! dateSelesaiTanam.value) {
        pickerSelesaiTanam.setOptions({
            startDate: date
        })
    }

    pickerSelesaiTanam.setOptions({
        minDate: date
    })
})
