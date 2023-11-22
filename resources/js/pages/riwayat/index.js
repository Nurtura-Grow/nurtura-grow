import $ from 'jquery';

const judulHalaman = document.getElementById('judulHalaman');
const buttonTambah = document.getElementById('buttonTambah')
const navigationBar = document.getElementById('navigationBar');

const navButtons = navigationBar.querySelectorAll('.nav-link');

navButtons.forEach(button => {
    button.addEventListener('click', () => {
        if (button.textContent == " Data Sensor ") {
            buttonTambah.classList.add('hidden');
        } else {
            buttonTambah.classList.remove('hidden');
        }

        buttonTambah.innerHTML = '<i class="fa-solid fa-circle-plus mr-2"></i>' + 'Tambah' + button
            .textContent + 'Manual';

        var routeName;
        if (button.textContent == " Tinggi Tanaman ") {
            routeName = routeTinggi;
        } else if (button.textContent == " Pemupukan ") {
            routeName = routePemupukan;
        } else if (button.textContent == " Pengairan ") {
            routeName = routePengairan;
        } else {
            // Default case if none of the above conditions are met
            routeName = ''; // or provide a default value
        }

        buttonTambah.setAttribute('href', routeName);
        judulHalaman.textContent = 'Riwayat ' + button.textContent;
    });
});

// Handle resize
window.addEventListener('resize', function () {
    document.querySelectorAll('.tab-pane').forEach(tab => {
        tab.style.width = '100%';
    });
})

$(document).on('click', '#riwayat-sensor', function () {
    $('#data-sensor').removeAttr('style');
});
