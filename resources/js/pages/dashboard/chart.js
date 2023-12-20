import $ from 'jquery';
import { Chart } from "chart.js/auto";
import crosshair from 'chartjs-plugin-crosshair';
import moment from "moment";
import { isEmpty } from 'lodash';

Chart.register(crosshair);

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

// If "lainnya" is chosen, set hidden class on .dateLainnya
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
// Pilih Jenis Grafik
$('#pilihGrafik').on('change', function () {
    label = $(this).val();
    getDataAndUpdateChart(label);
});

// Tanggal yang dipilih
$('#pilihTanggal').on('click', function () {
    tanggalDari = $('#tanggal_dari').val();
    tanggalHingga = $('#tanggal_hingga').val();

    getDataAndUpdateChart(label, tanggalDari = tanggalDari, tanggalHingga = tanggalHingga)
});

// Declare chart instance outside the functions
let chartInstance;

// Function to update data to the chart
function addData(label, newData) {
    chartInstance.data.datasets[0].label = "Rata-rata " + label;
    chartInstance.data.datasets[0].data = newData;

    if (label == "pH Tanah") {
        chartInstance.options.scales.y.max = 14;
    } else {
        chartInstance.options.scales.y.max = 100;
    }

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
            if (isEmpty(response.data.timestamp_pengukuran)) {
                if (chartInstance) {
                    chartInstance.destroy();
                    chartInstance = null;
                }

                $('#grafik-keseluruhan').remove(); // this is my <canvas> element
                $('#container-grafik').append('<canvas class="w-fit h-fit" id="grafik-keseluruhan"><canvas>');

                const canvas = document.querySelector('#grafik-keseluruhan');
                const ctx = canvas.getContext('2d');

                ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear previous content
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.font = '24px Roboto';
                ctx.fillText("Tidak ada data", canvas.width / 2, canvas.height / 2);
            } else {
                var x, y;
                var x = response.data.timestamp_pengukuran;
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
                const convertedData = x.map((timestamp, index) => ({
                    x: timestamp,
                    y: y[index],
                }));

                // Call the function to update the chart with new data
                updateGraphs(convertedData, labelParam);
            }
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
                label: "Rata-rata " + label,
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
                        minRotation: 0,
                        maxRotation: 0,
                    }
                },
                y: {
                    min: 0,
                    max: 100,
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

        const config = {
            type: 'line',
            data: data,
            options: options,
            plugins: [crosshair],
        };

        // Create a new Chart.js instance and store it in the chartInstance variable
        chartInstance = new Chart(grafikKeseluruhan, config);
    }
}

// Initial call to get data from the server and create/update the chart
getDataAndUpdateChart();
