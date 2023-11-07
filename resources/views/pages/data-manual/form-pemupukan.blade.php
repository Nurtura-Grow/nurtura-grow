<div class="intro-y box mt-5" id="pemupukan">
    <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
        <h2 class="font-medium text-base mr-auto">
            Pemupukan
        </h2>
    </div>
    <div class="p-5">
        <form>
            <label for="id_lahan" class="form-label">Nama Lahan</label>
            <select class="form-control tom-select mt-2" data-placeholder="Pilih lahan" name="id_lahan">
                @foreach ($seluruhLahan as $lahan)
                    <option value="{{ $lahan->id_lahan }}">{{ $lahan->nama_lahan }} ||
                        {{ $lahan->kecamatan }},
                        {{ $lahan->kota }}</option>
                @endforeach
            </select>

            <label for="vertical-form-1" class="form-label mt-5">Nama Penanaman</label>
            <input id="vertical-form-1" type="text" class="form-control" placeholder="example@gmail.com">

            <label for="vertical-form-1" class="form-label mt-5">Volume</label>
            <input id="vertical-form-1" type="text" class="form-control" placeholder="example@gmail.com">

            <label for="vertical-form-1" class="form-label mt-5">Tanggal Pemupukan</label>
            <div class="relative w-56">
                <div
                    class="absolute top-0 left-0 rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500">
                    <i class="fa-solid fa-calendar w-4 h-4"></i>
                </div>
                <input name="tanggal_pemupukan" type="text" class="form-control datepicker pl-12"
                    data-single-mode=true>
            </div>

            <label for="vertical-form-1" class="form-label mt-5">Waktu</label>
            <div class="grid grid-cols-12 gap-2">
                <input type="text" class="form-control col-span-4" placeholder="Waktu Mulai"
                    aria-label="default input inline 1">
                <input type="text" class="form-control col-span-4" placeholder="Waktu Selesai"
                    aria-label="default input inline 2">
            </div>

            <button type="submit" class="btn btn-primary mt-5 px-10">Masukkan</button>
        </form>
    </div>
</div>
