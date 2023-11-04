@extends('layout.side-menu')

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Daftar Tanaman
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <a href="{{ route('tanaman.create') }}">
                <button class="btn bg-rgb-secondary text-white shadow-md">
                    <i class="fa-solid fa-circle-plus mr-2"></i>Tambah Tanaman
                </button>
            </a>
        </div>
    </div>

    <div class="intro-y box p-5 mt-5">
        <div class="overflow-x-auto scrollbar-hidden">
            <table id="table" class="display hover overflow-x-auto">
                <thead>
                    <tr>
                        <th class="border-b-2 whitespace-nowrap">No</th>
                        <th class="border-b-2 whitespace-nowrap">Lahan</th>
                        <th class="border-b-2 whitespace-nowrap">Nama Penanaman</th>
                        <th class="border-b-2 whitespace-nowrap">Tanggal Tanam</th>
                        <th class="border-b-2 whitespace-nowrap">Hari Setelah Tanam</th>
                        <th class="border-b-2 whitespace-nowrap">Status</th>
                        <th class="border-b-2 whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($seluruhPenanaman as $penanaman)
                        <tr>
                            <td class="border-b">{{ $loop->index + 1 }}</td>
                            <td class="border-b">{{ $penanaman->nama_lahan }}</td>
                            <td class="border-b">{{ $penanaman->nama_penanaman }}</td>
                            <td class="border-b">{{ $penanaman->tanggal_tanam }}</td>
                            <td class="border-b">
                                <div class="progress h-5">
                                    <div class="progress-bar w-[{{ $penanaman->persentase }}%]" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                        aria-valuemax="100">{{ $penanaman->hst }}</div>
                                </div>
                            </td>
                            @if ($penanaman->status_hidup == 1)
                                <td class="border-b text-success"><i class="fa-regular fa-square-check mr-2"></i>Aktif</td>
                            @elseif ($penanaman->status_hidup == 0)
                                <td class="border-b text-danger"><i class="fa-solid fa-square-xmark mr-2"></i>Tidak Aktif
                                </td>
                            @endif
                            <td class="border-b">{{ $loop->index + 1 }}</td>
                        </tr>
                    @endforeach
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script> --}}
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/css/dataTables.tailwindcss.min.css"></script>
    @vite('resources/js/pages/datatable.js')
@endpush
