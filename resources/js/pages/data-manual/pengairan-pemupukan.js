import $ from 'jquery';

// Menyesuaikan satuan volume
const satuan = document.getElementById('satuan');
if (satuan) {
    satuan.addEventListener('change', function () {
        const volume = document.getElementById('volume');
        if (satuan.value == "mL") {
            volume.value = volume.value * 1000;
        } else if (satuan.value == "L") {
            volume.value = volume.value / 1000;
        }
    })
}


// Tidak, ikuti rekomendasi sistem
$('#jalankan-rekomendasi').on('click', function () {
    $('#jalankan-aksi-sekarang').addClass('hidden');
    $('#rekomendasi-sistem').removeClass('hidden');
})

// Batalkan mengikuti rekomendasi sistem
$('#batalkan').on('click', function () {
    $('#jalankan-aksi-sekarang').removeClass('hidden');
    $('#rekomendasi-sistem').addClass('hidden');
})

// Tampilkan SOP dan Rekomendasi
$('#button-tampilkan-sop').on('click', function () {
    $('#judul-section-sop').removeClass('hidden');
    $('#section-rekomendasi').removeClass('hidden');
    $('#button-tampilkan-sop').addClass('hidden');
})

// Sembunyikan rekomendasi & SOP
$('#sembunyikan-section-rekomendasi').on('click', function () {
    $('#judul-section-sop').addClass('hidden');
    $('#section-rekomendasi').addClass('hidden');
    $('#button-tampilkan-sop').removeClass('hidden');
})
