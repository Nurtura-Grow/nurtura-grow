@push('styles')
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css" /> --}}
    <link rel="stylesheet" href="{{ asset('css/datatables/jquery.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/datatables/responsive.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/datatables/rowgroup.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/datatable-custom.css') }}">
@endpush

@push('scripts')
    @vite(['resources/js/jquery.js', 'resources/js/pages/datatable.js', 'resources/js/datatable/jquery.dataTables.js', 'resources/js/datatable/responsive.js'])
@endpush
