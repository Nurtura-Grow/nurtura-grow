<table id="table" class="hover intro-y overflow-hidden" style="width:100%">
    <thead>
        <tr>
            <th class="border-b-2 whitespace-nowrap">No</th>
            <th class="border-b-2 whitespace-nowrap">Nama Penanaman</th>
            <th class="border-b-2 whitespace-nowrap">Nama Lahan</th>
            <th class="border-b-2 whitespace-nowrap">Mode</th>
            <th class="border-b-2 whitespace-nowrap">Tipe Aksi</th>
            <th class="border-b-2 whitespace-nowrap">Volume</th>
            <th class="border-b-2 whitespace-nowrap">Durasi</th>
            <th class="border-b-2 whitespace-nowrap">Waktu Mulai</th>
            <th class="border-b-2 whitespace-nowrap">Waktu Selesai</th>
            <th class="border-b-2">Perintah akan dikirim?</th>
            <th class="border-b-2 whitespace-nowrap">Status</th>
            <th class="border-b-2 whitespace-nowrap">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($logAksi as $log)
            <tr>
                <td class="border-b">{{ $loop->index + 1 }}</td>
                <td class="border-b">{{ $log->nama_penanaman }}</td>
                <td class="border-b">{{ $log->nama_lahan }}</td>
                <td class="border-b">{{ $log->mode }}</td>
                <td class="border-b">{{ $log->tipe }}</td>
                <td class="border-b">{{ $log->volume_liter }}</td>
                <td class="border-b">{{ $log->durasi_detik }}</td>
                <td class="border-b">{{ $log->waktu_mulai }}</td>
                <td class="border-b">{{ $log->waktu_selesai }}</td>
                <td class="border-b">{{ $log->perintah_akan_dikirim }}</td>
                <td class="border-b">{{ $log->status }}</td>
                <td class="border-b whitespace-nowrap">
                    @if ($log->aksi == true)
                        <a href="" class="btn mr-4 whitespace-nowrap">
                            <i class="w-4 h-4 mr-1 fa-solid fa-pencil"></i>Ubah
                        </a>
                        <a href="" class="btn btn-danger mr-4 whitespace-nowrap">
                            <i class="w-4 h-4 mr-1 fa-solid fa-trash"></i>Hapus
                        </a>
                    @else
                        Tidak dapat diubah
                    @endif

                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- Modal Delete --}}
<div id="deleteTanaman" class="modal" tabindex="-1" aria-hidden="true" data-tw-backdrop="static">
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
