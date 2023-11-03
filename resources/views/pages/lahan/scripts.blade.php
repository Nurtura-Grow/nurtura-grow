@push('scripts')
    <script>
        var url = '{{ route('lahan.search') }}';
        var seluruhLahan = @json($seluruhLahan);
        var lahan = {!! isset($lahan) ? json_encode($lahan) : 'null' !!};

        function deleteModal(idLahan) {
            $("#deleteLahan").attr("action", `/lahan/${idLahan}`);
        }
    </script>
    @vite(['resources/js/pages/searchLahan.js', 'resources/js/pages/googleMaps.js'])
@endpush
