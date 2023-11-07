<div class="intro-y box mt-5" id="tinggiTanaman">
    <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
        <h2 class="font-medium text-base mr-auto">
            Tinggi Tanaman
        </h2>
    </div>
    <div class="p-5">
        <form>
            @include('pages.data-manual.nama-lahan')

            <label for="tanggal_pengairan" class="form-label mt-5">Tanggal Pencatatan</label>
            <div class="relative w-56">
                <div
                    class="absolute top-0 left-0 rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500">
                    <i class="fa-solid fa-calendar w-4 h-4"></i>
                </div>
                <input name="tanggal_pengairan" type="text" class="form-control datepicker pl-12"
                    data-single-mode=true>
            </div>

            <label for="tinggi_tanaman" class="form-label mt-5">Tinggi Tanaman</label>
            <div class="input-group w-56">
                <input name="tinggi_tanaman" type="text" class="form-control" placeholder="10">
                <div class="input-group-text">cm</div>
            </div>

            <button type="submit" class="btn btn-primary mt-5 px-10">Masukkan</button>
        </form>
    </div>
</div>
