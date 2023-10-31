@foreach ($seluruhLahan as $lahan)
    <div class="p-3 cursor-pointer hover:bg-slate-100 rounded-md flex items-center">
        <div class="flex flex-row gap-3">
            <div class="flex-initial">
                <i class="fa-solid fa-location-dot"></i>
            </div>
            <div class="w-full">
                <p class="font-bold"> {{ $lahan->nama_lahan }}</p>
                <p class="font-medium text-primary">Kecamatan, Kota</p>
            </div>
        </div>
    </div>
@endforeach
