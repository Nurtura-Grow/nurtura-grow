import $ from 'jquery';
import { Chart } from "chart.js/auto";
import crosshair from 'chartjs-plugin-crosshair';
import moment from "moment";
import { isEmpty } from 'lodash';

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
function addData(chart, actualData, predictedData) {
    chart.data.datasets[0].data = actualData;
    chart.data.datasets[1].data = predictedData;
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
            if (isEmpty(response.data.timestamp_pengukuran)) {
                chartInstances = {
                    'suhu': null,
                    'kelembapan_udara': null,
                    'kelembapan_tanah': null,
                    'ph_tanah': null
                };

                $('.grafik-data').remove(); // this is my <canvas> element
                $('#container_suhu').append('<canvas class="grafik-data w-full h-full" id="suhu"></canvas>')
                $('#container_kelembapan_udara').append('<canvas class="grafik-data w-full h-full" id="kelembapan_udara"></canvas>')
                $('#container_kelembapan_tanah').append('<canvas class="grafik-data w-full h-full" id="kelembapan_tanah"></canvas>')
                $('#container_ph_tanah').append('<canvas class="grafik-data w-full h-full" id="ph_tanah"></canvas>')

                const canvases = document.querySelectorAll('.grafik-data');

                canvases.forEach((canvas) => {
                    const ctx = canvas.getContext('2d');

                    ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear previous content
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    ctx.font = '16px Roboto';
                    ctx.fillText("Tidak ada data", canvas.width / 2, canvas.height / 2);
                });
            } else {
                const x = response.data.timestamp_pengukuran;
                const y = response.data[chartId];
                const actualData = x.map((timestamp, index) => ({
                    x: timestamp,
                    y: y[index],
                }));

                const xPrediksi = response.prediksi.timestamp_prediksi_sensor;
                const yPrediksi = response.prediksi[chartId];
                const predictedData = xPrediksi.map((timestamp, index) => ({
                    x: timestamp,
                    y: yPrediksi[index],
                }));

                // Call the function to update the chart with new data
                if (chartInstances[chartId]) {
                    addData(chartInstances[chartId], actualData, predictedData);
                } else {
                    createChart(chartId, actualData, predictedData);
                }
            }
        },
        error: function (err) {
            console.log(err);
        }
    });
}

// Function to create the chart
function createChart(chartId, actualData, predictedData) {
    const canvas = document.getElementById(chartId);
    const data = {
        datasets: [
            {
                label: labelMapping[chartId],
                data: actualData,
                fill: false,
                backgroundColor: 'rgb(75, 192, 192)',
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            },
            {
                label: 'Prediksi ' + labelMapping[chartId],
                data: predictedData,
                fill: false,
                backgroundColor: '#F6AE2D',
                borderColor: '#F6AE2D',
                tension: 0.1
            }
        ]
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
            tooltip: {
                mode: 'index',
                intersect: false
            },
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
