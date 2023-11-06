@push('scripts')
    <script>
        document.querySelector('#inputPenanaman').addEventListener("change", function() {
            const keteranganPenanaman = document.querySelector('#keteranganPenanaman');
            const selesaiTanam = document.querySelector("#selesaiTanam");
            if (this.checked) {
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
@endpush
