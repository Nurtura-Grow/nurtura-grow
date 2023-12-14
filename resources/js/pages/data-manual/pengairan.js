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

const suhuMinimal = 25;
const suhuMaksimal = 33;
const kelembapanUdaraMinimal = 60;
const kelembapanUdaraMaksimal = 69;
const kelembapanTanahMinimal = 50;
const kelembapanTanahMaksimal = 69;
const phTanahMinimal = 5.5;
const phTanahMaksimal = 6.5;

$('#pilihGrafik').on('change', function () {
    label = $(this).val();
    getDataAndUpdateChart(label);
});

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
    chartInstance.options.scales.y.max = 100;
    chartInstance.options.scales.y.min = 0;

    chartInstance.data.datasets[1].label = label + " Minimum";
    chartInstance.data.datasets[2].label = label + " Maksimum";

    chartInstance.data.datasets[0].label = label;
    chartInstance.data.datasets[0].data = newData;

    // Update standard data based on label
    switch (label) {
        case 'Suhu Udara':
            chartInstance.data.datasets[1].data = newData.map(data => ({ x: data.x, y: suhuMinimal }));
            chartInstance.data.datasets[2].data = newData.map(data => ({ x: data.x, y: suhuMaksimal }));
            chartInstance.options.scales.y.max = 50;
            chartInstance.options.scales.y.min = 0;
            break;
        case 'Kelembapan Udara':
            chartInstance.data.datasets[1].data = newData.map(data => ({ x: data.x, y: kelembapanUdaraMinimal }));
            chartInstance.data.datasets[2].data = newData.map(data => ({ x: data.x, y: kelembapanUdaraMaksimal }));
            break;
        case 'Kelembapan Tanah':
            chartInstance.data.datasets[1].data = newData.map(data => ({ x: data.x, y: kelembapanTanahMinimal }));
            chartInstance.data.datasets[2].data = newData.map(data => ({ x: data.x, y: kelembapanTanahMaksimal }));
            break;
        case 'pH Tanah':
            chartInstance.data.datasets[1].data = newData.map(data => ({ x: data.x, y: phTanahMinimal }));
            chartInstance.data.datasets[2].data = newData.map(data => ({ x: data.x, y: phTanahMaksimal }));
            break;
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
            $('#tanggalTerpilih').text(response.data.tanggalDari + ' - ' + response.data.tanggalHingga);
            if (isEmpty(response.data.timestamp_pengukuran)) {
                if (chartInstance) {
                    chartInstance.destroy();
                    chartInstance = null;
                }

                $('#grafik-pengairan').remove();
                $('#container-grafik').append('<canvas class="w-fit h-fit" id="grafik-pengairan"></canvas>');

                const canvas = document.querySelector('#grafik-pengairan');

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
function updateGraphs(dataGraphic, labelParam = label) {
    // Check if the chart already exists
    if (chartInstance) {
        // Add the new data to the chart
        addData(labelParam, dataGraphic);
    } else {
        // If the chart doesn't exist, create a new chart
        const grafikPengairan = document.getElementById('grafik-pengairan');
        const data = {
            datasets: [
                {
                    label: labelParam,
                    data: dataGraphic,
                    borderColor: 'blue',
                    fill: false,
                },
                // Minimum
                {
                    label: labelParam + " Minimal",
                    data: Array(dataGraphic.length).fill(suhuMinimal),
                    borderColor: '#57B492',
                    fill: false,
                },
                // Maksimum
                {
                    label: labelParam + " Maksimal",
                    data: Array(dataGraphic.length).fill(suhuMaksimal),
                    borderColor: '#57B492',
                    backgroundColor: 'rgba(87, 180, 146, 0.2)',
                    fill: '-1',
                },
            ]
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
                    max: 50,
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

        const config = {
            type: 'line',
            data: data,
            options: options,
            plugins: [crosshair],
        };

        // Create a new Chart.js instance and store it in the chartInstance variable
        chartInstance = new Chart(grafikPengairan, config);
    }
}

getDataAndUpdateChart();
