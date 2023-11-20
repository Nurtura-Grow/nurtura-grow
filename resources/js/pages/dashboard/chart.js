import { Chart } from "chart.js/auto";

const grafikKeseluruhan = document.getElementById('grafik-keseluruhan');

const MONTHS = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December'
];

const labels = MONTHS.slice(0, 7);
const data = {
    labels: labels,
    datasets: [{
        label: 'My First Dataset',
        data: [65, 59, 80, 81, 56, 55, 40],
        fill: false,
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

const chart = new Chart(grafikKeseluruhan, config);
