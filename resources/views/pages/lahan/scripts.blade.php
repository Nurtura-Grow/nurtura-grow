@push('scripts')
    <script>
        var seluruhLahan = @json($seluruhLahan);
    </script>
    @vite(['resources/js/pages/googleMaps.js'])
@endpush
