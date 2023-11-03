@push('scripts')
    <script>
        var url = '{{ route('lahan.search') }}';
        var seluruhLahan = @json($seluruhLahan);
    </script>
    @vite(['resources/js/pages/searchLahan.js', 'resources/js/pages/googleMaps.js'])
@endpush
