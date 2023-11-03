@push('scripts')
    <script>
        var url = '{{ route('lahan.search') }}';
        var seluruhLahan = @json($seluruhLahan);
    </script>
    @vite(['resources/js/pages/googleMaps.js', 'resources/js/pages/searchLahan.js'])
@endpush
