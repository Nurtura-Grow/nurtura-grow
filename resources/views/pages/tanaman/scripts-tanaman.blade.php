@push('scripts')
    <script>
        var aktif = {{ isset($penanaman) && $penanaman->status_hidup == 1 ? 'true' : 'false' }};
        document.querySelector('#inputPenanaman').addEventListener("change", function() {
            const keteranganPenanaman = document.querySelector('#keteranganPenanaman');
            const selesaiTanam = document.querySelector("#selesaiTanam");

            aktif = this.checked;
            if (aktif) {
                selesaiTanam.classList.add('hidden');
                keteranganPenanaman.innerHTML =
                    'Penanaman <span class="text-primary font-semibold">sedang berlangsung</span>. Tekan tombol <i class="fa-solid fa-toggle-on text-primary"></i> di kiri untuk menandakan penanaman sudah selesai';
            } else {
                selesaiTanam.classList.remove('hidden');
                keteranganPenanaman.innerHTML =
                    'Penanaman <span class="text-primary font-semibold">sudah selesai</span>. Tekan tombol <i class="fa-solid fa-toggle-off"></i> di kiri untuk menandakan penanaman sedang berlangsung';
            }
        })
    </script>

    @vite(["resources/js/pages/litepicker.js",])
@endpush
