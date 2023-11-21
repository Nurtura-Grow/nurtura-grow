<table id="table" class="hover intro-y overflow-hidden" style="width:100%">
    <thead>
        <tr>
            <th class="border-b-2 whitespace-nowrap">No</th>
            <th class="border-b-2 whitespace-nowrap">Nama Penanaman</th>
            <th class="border-b-2 whitespace-nowrap">Nama Lahan</th>
            <th class="border-b-2 whitespace-nowrap">Suhu Udara</th>
            <th class="border-b-2 whitespace-nowrap">Kelembapan Udara</th>
            <th class="border-b-2 whitespace-nowrap">Kelembapan Tanah</th>
            <th class="border-b-2 whitespace-nowrap">pH Tanah</th>
            <th class="border-b-2 whitespace-nowrap">Diukur pada</th>
        </tr>
    </thead>
    <tbody>
        @for ($i = 0; $i < 10; $i++)
            <tr>
                <td class="border-b">{{ $i + 1 }}</td>
                <td class="border-b">Blablabla</td>
                <td class="border-b">Blablabla</td>
                <td class="border-b">Blablabla</td>
                <td class="border-b">Blablabla</td>
                <td class="border-b">Blablabla</td>
                <td class="border-b">Blablabla</td>
                <td class="border-b">Blablabla</td>
            </tr>
        @endfor
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
