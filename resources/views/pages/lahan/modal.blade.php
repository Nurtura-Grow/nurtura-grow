<div id="delete-modal" class="modal" data-tw-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="p-5 text-center"> <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                <div class="text-3xl mt-5">Apakah Anda yakin?</div>
                <div class="text-slate-500 mt-2">
                    Apakah Anda sungguh ingin menghapus data ini? <br>Data ini tidak dapat dikembalikan.
                </div>
            </div>
            <div class="px-5 pb-8 text-center">
                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">
                    Batalkan
                </button>

                <form method="POST" id="deleteLahan">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger w-24">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
