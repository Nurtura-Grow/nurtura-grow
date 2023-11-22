import $ from 'jquery';
import { Chart } from "chart.js/auto";
import crosshair from 'chartjs-plugin-crosshair';
import moment from "moment";
import Litepicker from 'litepicker';
import 'litepicker/dist/plugins/mobilefriendly';

// Register plugin crosshair
Chart.register(crosshair);

/**
 * Litepicker
 */

// Default Variables
const today = moment().format('DD MMM YYYY');
var dateChosen = 'today';
var tanggalDari = today;
var tanggalHingga = today;

// Declare chart instances for each graph
let chartInstances = {
    'suhu': null,
    'kelembapan_udara': null,
    'kelembapan_tanah': null,
    'ph_tanah': null
};

const labelMapping = {
    'suhu': 'Suhu Udara',
    'kelembapan_udara': 'Kelembapan Udara',
    'kelembapan_tanah': 'Kelembapan Tanah',
    'ph_tanah': 'pH Tanah'
};


/**
 * Chart JS
 * */

function updateAllCharts() {
    Object.keys(chartInstances).forEach((chartId) => {
        getDataAndUpdateChart(chartId, tanggalDari, tanggalHingga);
    });
}

// Button Logic
$('.chooseDate').on('click', function () {
    // Add bg-primary class
    $(this).addClass('bg-primary text-white font-semibold');
    $('.chooseDate').not(this).removeClass('bg-primary text-white font-semibold');
    dateChosen = $(this).attr('id');

    // Show or hide additional date selection
    if ($(this).attr('id') == 'lainnya') {
        $('.dateLainnya').toggleClass('hidden');
    } else {
        $('.dateLainnya').addClass('hidden');
    }
});

// Tanggal yang dipilih
$('#pilihTanggal').on('click', function () {
    tanggalDari = $('#tanggal_dari').val();
    tanggalHingga = $('#tanggal_hingga').val();

    updateAllCharts();
});

// Function to update data to the chart
function addData(chart, newData) {
    chart.data.datasets[0].data = newData;
    chart.update();
}

// Function to get data from the server and update the chart
function getDataAndUpdateChart(chartId) {
    // AJAX to get data from the server
    $.ajax({
        url: urlDashboard,
        method: 'GET',
        dataType: 'json',
        data: {
            dateChosen: dateChosen,
            tanggalDari: tanggalDari,
            tanggalHingga: tanggalHingga
        },

        success: function (response) {
            $('#tanggalTerpilih').text(response.data.tanggalDari + ' - ' + response.data.tanggalHingga);

            const x = response.data.timestamp_pengukuran;
            const y = response.data[chartId]; // Assuming the data keys match the chart IDs
            const convertedData = x.map((timestamp, index) => ({
                x: timestamp,
                y: y[index],
            }));

            // Call the function to update the chart with new data
            if (chartInstances[chartId]) {
                addData(chartInstances[chartId], convertedData);
            } else {
                createChart(chartId, convertedData);
            }
        },
        error: function (err) {
            console.log(err);
        }
    });
}

// Function to create the chart
function createChart(chartId, dataGraphic) {
    const canvas = document.getElementById(chartId);
    const data = {
        datasets: [{
            label: labelMapping[chartId],
            data: dataGraphic,
            fill: false,
            backgroundColor: 'rgb(75, 192, 192)',
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
    };

    const options = {
        scales: {
            x: {
                ticks: {
                    autoSkip: true,
                    autoSkipPadding: 10,
                    minRotation: 0,
                    maxRotation: 0,
                }
            },
            y: {
                min: 0,
                max: chartId == 'ph_tanah' ? 14 : 100,
            }
        },
        plugins: {
            legend: {
                display: false
            },
            crosshair: {
                line: {
                    color: '#C3C6CD',  // crosshair line color
                    width: 1,        // crosshair line width
                    dashPattern: [5, 5] // crosshair line dash pattern
                },
                sync: {
                    enabled: true,            // enable trace line syncing with other charts
                    group: 1,                 // chart group
                    suppressTooltips: false   // suppress tooltips when showing a synced tracer
                },
                zoom: {
                    enabled: false, // enable zooming
                },
                snap: {
                    enabled: true, // enable snapping to data points
                }
            }
        }
    };

    chartInstances[chartId] = new Chart(canvas, {
        type: 'line',
        data: data,
        options: options,
    });
}

// Initial call to create each chart
Object.keys(chartInstances).forEach((chartId) => {
    getDataAndUpdateChart(chartId);
});
