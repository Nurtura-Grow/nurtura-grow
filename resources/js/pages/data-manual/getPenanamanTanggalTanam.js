import $ from 'jquery';
import Litepicker from 'litepicker';
import 'litepicker/dist/plugins/mobilefriendly';
import moment from 'moment';

/** Satuan */
// Menyesuaikan satuan tinggi tanaman
const satuan = document.getElementById('satuan');
if (satuan) {
    satuan.addEventListener('change', function () {
        const tinggi_tanaman = document.getElementById('tinggi_tanaman');
        if (satuan.value == "mm") {
            tinggi_tanaman.value = tinggi_tanaman.value * 10;
        } else if (satuan.value == "cm") {
            tinggi_tanaman.value = tinggi_tanaman.value / 10;
        }
    })
}

/** Litepicker */
// Create Litepicker Element
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

const dateTinggi = document.querySelector(".dateTinggi");
if (dateTinggi) {

    const datePickerTinggi = new Litepicker({
        element: dateTinggi,
        ...customOptions,
    })

    // Change Value of Datepicker
    function changeDatePickerTinggiValue(tanggal_tanam) {
        datePickerTinggi.setOptions({
            minDate: tanggal_tanam,
            setDate: tanggal_tanam,
            maxDate: moment().format("DD MMM YYYY"),
        });
    }

    /** AJAX */
    function makeAjaxRequest(id_penanaman) {
        // Replace :id with the value of id_penanaman
        const formattedUrl = url.replace(':id', id_penanaman);

        // Make the AJAX request using jQuery
        $.ajax({
            url: formattedUrl,
            method: 'GET',
            success: function (data) {
                // Handle the response data
                const tanggal_tanam = data.tanggal_tanam;
                changeDatePickerTinggiValue(tanggal_tanam);
            },
            error: function (xhr, status, error) {
                // Handle errors
                console.error('AJAX error:', error);
            }
        });
    }

    // Initial AJAX request with default value
    makeAjaxRequest($('#id_penanaman').val());

    // Change event handler
    $('#id_penanaman').on('change', function () {
        const id_penanaman = $(this).val();
        // Make the AJAX request using the function
        makeAjaxRequest(id_penanaman);
    });

}
