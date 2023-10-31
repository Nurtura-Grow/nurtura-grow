@extends('layout.side-menu')

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Riwayat Tinggi Tanaman
        </h2>
    </div>

    <div class="intro-y box p-5 mt-5">
        <div class="overflow-x-auto scrollbar-hidden">
            <table id="table" class="stripe hover overflow-x-auto">
                <thead>
                    <tr>
                        <th class="border-b-2 whitespace-nowrap">Name</th>
                        <th class="border-b-2 whitespace-nowrap">Category</th>
                        <th class="border-b-2 whitespace-nowrap">Remaining Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 1; $i < 10; $i++)
                        <tr>
                            <td class="border-b">Item {{ $i }}</td>
                            <td class="border-b">Category {{ $i }}</td>
                            <td class="border-b">{{ $i * 10 }}</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script> --}}
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    @vite('resources/js/pages/datatable.js')
@endpush
