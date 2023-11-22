@push('scripts')
    <script>
        var url = '{{ route('lahan.search') }}';
        var seluruhLahan = @json($seluruhLahan);
        var lahan = {!! isset($lahan) ? json_encode($lahan) : 'null' !!};

        var routeName = '{{ $sideMenu['active_first_menu'] }}';

        function deleteModal(idLahan) {
            $("#deleteLahan").attr("action", `/lahan/${idLahan}`);
        }
    </script>
    {{-- @vite(['resources/js/pages/lahan/searchLahan.js', 'resources/js/pages/lahan/googleMaps.js']) --}}
@endpush
