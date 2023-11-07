<div class="intro-y box mt-5" id="pemupukan">
    <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
        <h2 class="font-medium text-base mr-auto">
            Pemupukan
        </h2>
    </div>
    <div class="p-5">
        <form>
            @include('pages.data-manual.nama-lahan')

            <label for="volume_pemupukan" class="form-label mt-5">Volume Pemupukan</label>
            <div class="input-group w-56">
                <input name="volume_pemupukan" type="text" class="form-control" placeholder="10">
                <div class="input-group-text">ml</div>
            </div>

            <label for="tanggal_pemupukan" class="form-label mt-5">Tanggal Pemupukan</label>
            <div class="relative w-56">
                <div
                    class="absolute top-0 left-0 rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500">
                    <i class="fa-solid fa-calendar w-4 h-4"></i>
                </div>
                <input name="tanggal_pemupukan" type="text" class="form-control datepicker pl-12"
                    data-single-mode=true>
            </div>

            <label for="Waktu" class="form-label mt-5">Waktu</label>
            <div class="grid grid-cols-12 gap-2">
                <input type="text" class="form-control col-span-4" placeholder="Waktu Mulai"
                    aria-label="default input inline 1" name="waktu_mulai">
                <input type="text" class="form-control col-span-4" placeholder="Waktu Selesai"
                    aria-label="default input inline 2" name="waktu_selesai">
            </div>

            <button type="submit" class="btn btn-primary mt-5 px-10">Masukkan</button>
        </form>
    </div>
</div>
