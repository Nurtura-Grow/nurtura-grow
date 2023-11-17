@push('scripts')
    <script>
        const url = `{{ route('manual.tinggi.search_tanggal', ['id' => ':id']) }}`
    </script>
    @vite(['resources/js/pages/flatpickr.js', 'resources/js/pages/getPenanamanTanggalTanam.js'])
@endpush
