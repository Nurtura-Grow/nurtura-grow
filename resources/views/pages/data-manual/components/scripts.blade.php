@push('scripts')
    <script>
        const url = `{{ route('manual.tinggi.search_tanggal', ['id' => ':id']) }}`

        const clickable = document.querySelectorAll('.clickable-box');
        clickable.forEach(box => {
            box.addEventListener('click', function(event) {
                const inputPengairan = box.querySelector('.input-pengairan');
                const inputPemupukan = box.querySelector('.input-pemupukan');

                if (inputPengairan) {
                    // Set the found 'common-input' radio input to checked
                    inputPengairan.checked = true;
                }

                if (inputPemupukan) {
                    // Set the found 'common-input' radio input to checked
                    inputPemupukan.checked = true;
                }
            });
        });
    </script>

    @vite(['resources/js/pages/data-manual/waktuMulaiSelesai', 'resources/js/pages/data-manual/getPenanamanTanggalTanam.js'])
@endpush
