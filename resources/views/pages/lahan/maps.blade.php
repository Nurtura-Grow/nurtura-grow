{{-- Masukin maps di sini --}}
<div class="col-span-12 lg:col-span-9">
    <div class="box p-5 intro-y h-full min-h-[70vh]">
        {{-- Fitur Search --}}
        <div class="absolute top-5 sm:top-8 left-10 z-[1000]" id="search-container">
            <div class="w-[200px] sm:w-auto relative mr-auto mt-3 sm:mt-0">
                <i class="w-4 h-4 absolute my-auto inset-y-0 ml-3 left-0 z-10 text-slate-500" data-lucide="search"></i>
                <input type="text" class="form-control w-full sm:w-64 box px-10" placeholder="Cari lokasi" id="search-bar">
            </div>
        </div>

        {{-- Maps --}}
        <div class="h-full" id="container-maps"></div>
    </div>
</div>
