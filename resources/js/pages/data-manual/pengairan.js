import $ from 'jquery';

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
