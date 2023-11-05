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
        <table id="table" class="hover" style="width:100%">
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
                                <div class="progress-bar" role="progressbar" style="width: {{ $penanaman->persentase }}%;"
                                    aria-valuenow="{{ $penanaman->persentase }}" aria-valuemin="0" aria-valuemax="100">
                                    {{ $penanaman->persentase . (intval($penanaman->persentase) >= 10 ? '%' : '') }}</div>
                            </div>
                            <p><span class="text-primary font-semibold">{{ $penanaman->hst }}</span> dari <span
                                    class="font-semibold">{{ $penanaman->default_hari }}</span> hari</p>
                        </td>
                        @if ($penanaman->status_hidup == 1)
                            <td class="border-b text-success"><i class="fa-regular fa-square-check mr-2"></i>Aktif</td>
                        @elseif ($penanaman->status_hidup == 0)
                            <td class="border-b text-danger"><i class="fa-solid fa-square-xmark mr-2"></i>Tidak Aktif
                            </td>
                        @endif
                        <td class="border-b">
                            <a href="{{ route('tanaman.edit', ['id' => $penanaman->id_penanaman]) }}"
                                class="mr-4 whitespace-nowrap">
                                <i class="w-4 h-4 mr-1 fa-solid fa-pencil"></i>Ubah
                            </a>
                            <span class="text-danger deletePenanaman hover:cursor-pointer whitespace-nowrap"
                                data-tanaman='{{ json_encode(['id_penanaman' => $penanaman->id_penanaman]) }}'
                                data-tw-toggle="modal" data-tw-target="#deleteTanaman"><i
                                    class="w-4 h-4 mr-1 fa-solid fa-trash"></i>Hapus</span>
                        </td>
                    </tr>
                @endforeach
        </table>
    </div>

    {{-- Modal untuk Delete --}}
    <div id="deleteTanaman" class="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center"> <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">Apakah Anda yakin?</div>
                        <div class="text-slate-500 mt-2">
                            Apakah Anda sungguh ingin menghapus data ini? <br>Data ini tidak dapat dikembalikan.
                        </div>
                    </div>
                    <div class="px-5 pb-8 flex justify-center">
                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">
                            Batalkan
                        </button>

                        <form method="POST" id="formDeleteTanaman">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger w-24">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('pages.components.datatable-styles')
@push('scripts')
    <script>
        var deletePenanaman = document.querySelectorAll('.deletePenanaman');
        deletePenanaman.forEach(element => {
            element.addEventListener("click", function(event) {
                // Get data-tanaman attribute
                const dataTanaman = JSON.parse(element.getAttribute('data-tanaman')).id_penanaman;

                const route = "{{ route('tanaman.destroy', ['id' => ':id']) }}";
                const url = route.replace(':id', dataTanaman);

                // Change Form
                $('#formDeleteTanaman').attr('action', url);
            })
        });
    </script>
@endpush
