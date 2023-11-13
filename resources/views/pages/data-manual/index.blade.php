@extends('layout.side-menu')

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto" id="judulHalaman">
            Input Data Manual
        </h2>
    </div>

    @if ($seluruhLahan->first()->penanaman->count() > 0)
        <div class="grid grid-cols-12 gap-3 xl:gap-6">
            {{-- Menu Kiri --}}

            <div class="intro-y col-span-12 xl:col-span-3">
                <div class="box mt-5 pb-5 sticky top-10 xl:h-[90vh]">
                    <div class="px-4 pt-5">
                        <a class="flex rounded-lg items-center px-4 py-2 bg-primary text-white font-medium"
                            href="#tinggiTanaman">
                            <i class="fa-solid fa-ruler-vertical w-4 h-4 mr-2"></i>
                            <div class="flex-1 truncate">Tinggi Tanaman</div>
                        </a>
                        <a class="flex rounded-lg items-center px-4 py-2 mt-1" href="#pengairan">
                            <i class="w-4 h-4 mr-2 fa-solid fa-faucet-drip"></i>
                            <div class="flex-1 truncate">Pengairan</div>
                        </a>
                        <a class="flex rounded-lg items-center px-4 py-2 mt-1 " href="#pemupukan">
                            <i class="fa-brands fa-pagelines w-4 h-4 mr-2"></i>
                            <div class="flex-1 truncate">Pemupukan</div>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Form Kanan --}}
            <div class="intro-y col-span-12 xl:col-span-9">

                @include('pages.data-manual.form-tinggi-tanaman')
                @include('pages.data-manual.form-pengairan')
                @include('pages.data-manual.form-pemupukan')
            </div>
        </div>
    @else
        <div class="flex items-center justify-center h-[53vh] md:h-[70vh]">
            <div class="text-center ">
                <p class="mb-2 text-md xl:text-xl">Tidak ada penanaman, silahkan tambahkan penanaman terlebih dahulu.</p>
                <a class="inline-flex items-center btn bg-rgb-secondary border-2 border-rgb-secondary hover:bg-white py-2 px-4 text-white hover:text-rgb-secondary"
                    href="{{ route('tanaman.create') }}">
                    <i class="fa-solid fa-circle-plus mr-2"></i><span>Tambahkan Penanaman</span>
                </a>
            </div>
        </div>
    @endif
@endsection

