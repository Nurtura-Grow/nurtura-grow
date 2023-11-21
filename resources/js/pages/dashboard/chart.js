import { Chart } from "chart.js/auto";
import $ from 'jquery';
import moment from "moment";

// Default Variable
const today = moment().format('DD MMM, YYYY');
var label = 'Suhu Udara';
var dateChosen = 'today';
var tanggalDari = today;
var tanggalHingga = today;

// Button Logic
$('.chooseDate').on('click', function () {
    // Add bg-primary class
    $(this).addClass('bg-primary text-white font-semibold');

    $('.chooseDate').not(this).removeClass('bg-primary text-white font-semibold');

    dateChosen = $(this).attr('id');

    // If this has ID: "lainnya", do dateLainnya()
    if ($(this).attr('id') == 'lainnya') {
        datelainnya();

    } else {
        // If dateLainnya doesn't have hidden
        if (!$('.dateLainnya').hasClass('hidden')) {
            // Add hidden class on .dateLainnya
            $('.dateLainnya').addClass('hidden');
        }
    }
})

function datelainnya() {
    // If dateLainnya have hidden
    if ($('.dateLainnya').hasClass('hidden')) {
        // Remove hidden class on .dateLainnya
        $('.dateLainnya').removeClass('hidden');
    } else {
        // Add hidden class on .dateLainnya
        $('.dateLainnya').addClass('hidden');
    }
}

/** Chart JS */

$('#pilihGrafik').on('change', function () {
    label = $(this).val();
    getDataAndUpdateChart(label);
});

// Get the chosen date
$('#pilihTanggal').on('click', function () {
    tanggalDari = $('#tanggal_dari').val();
    tanggalHingga = $('#tanggal_hingga').val();

    getDataAndUpdateChart(label, tanggalDari = tanggalDari, tanggalHingga = tanggalHingga)
});

// Declare chart instance outside the functions
let chartInstance;

// Function to add data to the chart
function addData(label, newData) {
    chartInstance.data.datasets[0].label = label;
    chartInstance.data.datasets[0].data = newData;
    chartInstance.update();
}

// Function to get data from the server and update the chart
function getDataAndUpdateChart(labelParam = label, tanggalDariParam = tanggalDari, tanggalHinggaParam = tanggalHingga) {
    // AJAX to get data from the server
    $.ajax({
        url: urlDashboard,
        method: 'GET',
        dataType: 'json',
        data: {
            dateChosen: dateChosen,
            tanggalDari: tanggalDariParam,
            tanggalHingga: tanggalHinggaParam
        },
        success: function (response) {
            console.log('response', response.data.suhu);
            var x, y;
            switch (labelParam) {
                case 'Suhu Udara':
                    y = response.data.suhu
                    break;
                case 'Kelembapan Udara':
                    y = response.data.kelembapan_udara
                    break;
                case 'Kelembapan Tanah':
                    y = response.data.kelembapan_tanah
                    break;
                case 'pH Tanah':
                    y = response.data.ph_tanah
                    break;
            }

            var x = response.data.timestamp_pengukuran;

            console.log('x', x);
            console.log(y);

            const convertedData = x.map((timestamp, index) => ({
                x: timestamp,
                y: y[index],
            }));

            // Call the function to update the chart with new data
            updateGraphs(convertedData, labelParam);
        },
        error: function (err) {
            console.log(err);
        }
    });
}

// Function to update the chart with new data
function updateGraphs(dataGraphic, label = 'Suhu Udara') {
    // Check if the chart already exists
    if (chartInstance) {
        // Add the new data to the chart
        addData(label, dataGraphic);
    } else {
        // If the chart doesn't exist, create a new chart
        const grafikKeseluruhan = document.getElementById('grafik-keseluruhan');
        const data = {
            datasets: [{
                label: label,
                data: dataGraphic,
                fill: false,
                backgroundColor: 'rgb(75, 192, 192)',
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        };

        const options = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        const config = {
            type: 'line',
            data: data,
            options: options,
        };

        // Create a new Chart.js instance and store it in the chartInstance variable
        chartInstance = new Chart(grafikKeseluruhan, config);
    }
}

// Initial call to get data from the server and create/update the chart
getDataAndUpdateChart();
