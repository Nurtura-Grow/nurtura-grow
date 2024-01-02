import $ from 'jquery';

const judulHalaman = document.getElementById('judulHalaman');
const buttonTambah = document.getElementById('buttonTambah')
const navigationBar = document.getElementById('navigationBar');
const dropdownTambah = document.getElementById('dropdownTambah');

const navButtons = navigationBar.querySelectorAll('.nav-link');

navButtons.forEach(button => {
    button.addEventListener('click', () => {
        var textContent = button.textContent.trim();

        if (textContent == "Aksi Alat") {
            dropdownTambah.classList.remove('hidden');
            buttonTambah.classList.add('hidden');
            console.log(dropdownTambah.classList)
        } else if (textContent == "Tinggi Tanaman") {
            dropdownTambah.classList.add('hidden');
            buttonTambah.classList.remove('hidden');
        } else {
            dropdownTambah.classList.add('hidden');
            buttonTambah.classList.add('hidden');
        }

        judulHalaman.textContent = 'Riwayat ' + textContent;
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
