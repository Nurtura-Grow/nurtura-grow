@extends('layout.side-menu')

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Daftar Lahan
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button class="btn btn-secondary text-white shadow-md">
                <i class="fa-solid fa-circle-plus mr-2"></i>Tambah Lahan
            </button>
        </div>
    </div>

    {{-- Todo: kalau di mobile ganti single/responsive display dari:http://127.0.0.1:5500/side-menu-light-slider.html --}}
    <div class="grid grid-cols-12 gap-5 mt-5 intro-y">
        <div class="col-span-3">
            <div class="box p-5 intro-y">
                <div class="flex flex-col items-center">
                    {{-- Todo: ganti jadi input --}}
                    <button type="button" class="btn btn-primary w-full mt-2">
                        <i class="fa-solid fa-magnifying-glass w-4 h-4 mr-2"></i>
                        Cari Lahan
                    </button>

                    <div class="border-t border-b w-full border-slate-200/60 dark:border-darkmode-400 mt-6 mb-5 py-3 overflow-hidden">
                        <div class="overflow-y-auto scrollbar-hidden max-h-[calc(70vh-160px)]">
                            @for ($i = 1; $i <= 10; $i++)
                                <div class="p-3 cursor-pointer hover:bg-slate-100  rounded-md flex items-center">
                                    <div class="flex flex-row gap-3">
                                        <div class="flex-initial">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </div>
                                        <div class="w-full">
                                            <p class="font-bold"> Lahan {{ $i }}</p>
                                            <p class="font-medium text-primary">Kecamatan, Kota</p>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>

                    <div>
                        Tekan lahan untuk menunjukkan lokasi pada peta
                    </div>
                </div>
            </div>
        </div>

        {{-- Masukin maps di sini --}}
        <div class="col-span-9">
            <div class="box p-5 intro-y h-full">
                {{-- Todo: tambahin maps --}}
            </div>
        </div>
    </div>


    </div>
    </div>
@endsection
