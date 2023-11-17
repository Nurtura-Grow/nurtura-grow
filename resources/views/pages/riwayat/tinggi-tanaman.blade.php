<table id="table" class="hover intro-y overflow-hidden" style="width:100%">
    <thead>
        <tr>
            <th class="border-b-2 whitespace-nowrap">No</th>
            <th class="border-b-2 whitespace-nowrap">Nama Penanaman</th>
            <th class="border-b-2 whitespace-nowrap">Nama Lahan</th>
            <th class="border-b-2 whitespace-nowrap">HST</th>
            <th class="border-b-2 whitespace-nowrap">Tinggi Tanaman</th>
            <th class="border-b-2 whitespace-nowrap">Tanggal Tanam</th>
            <th class="border-b-2 whitespace-nowrap">Tanggal Pengukuran</th>
            <th class="border-b-2 whitespace-nowrap">Diukur Oleh</th>
            <th class="border-b-2 whitespace-nowrap">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tinggiTanaman as $tanaman)
            <tr>
                <td class="border-b">{{ $loop->index + 1 }}</td>
                <td class="border-b">{{ $tanaman->nama_penanaman }}</td>
                <td class="border-b">{{ $tanaman->nama_lahan }} </td>
                <td class="border-b">{{ $tanaman->hari_setelah_tanam }}</td>
                <td class="border-b">{{ $tanaman->tinggi_tanaman_mm }} mm</td>
                <td class="border-b">{{ $tanaman->tanggal_tanam }}</td>
                <td class="border-b">{{ $tanaman->ditambahkan_pada }}</td>
                <td class="border-b">{{ $tanaman->created_by }}</td>
                <td class="border-b">
                    <a href="{{ route('manual.tinggi.edit', ['tinggi' => $tanaman->id_tinggi_tanaman]) }}"
                        class="mr-4 whitespace-nowrap">
                        <i class="w-4 h-4 mr-1 fa-solid fa-pencil"></i>Ubah
                    </a>
                    <span class="text-danger deleteRiwayatTinggi hover:cursor-pointer whitespace-nowrap"
                        data-tanaman='{{ $tanaman->id_tinggi_tanaman }}' data-tw-toggle="modal" onclick="changeAttribute(this)"
                        data-tw-target="#deleteRiwayatTinggi"><i class="w-4 h-4 mr-1 fa-solid fa-trash"></i>Hapus</span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- Modal untuk Delete --}}
<div id="deleteRiwayatTinggi" class="modal" tabindex="-1" aria-hidden="true">
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

                    <form method="POST" id="formRiwayatTinggi">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger w-24">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function changeAttribute(element) {
            console.log("click");
            const formRiwayatTinggi = document.getElementById('formRiwayatTinggi');
            console.log(formRiwayatTinggi);
            console.log(element.getAttribute('data-tanaman'));
            formRiwayatTinggi.setAttribute('action', '/manual/tinggi/' + element.getAttribute(
                'data-tanaman'));
        };
    </script>
@endpush
