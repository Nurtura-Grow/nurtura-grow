@extends('layout.side-menu')

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Daftar Lahan
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <a href="{{ route('lahan.create') }}">
                <button class="btn bg-rgb-secondary text-white shadow-md">
                    <i class="fa-solid fa-circle-plus mr-2"></i>Tambah Lahan
                </button>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-5 mt-5 intro-y">
        <div class="col-span-12 lg:col-span-3">
            <div class="box p-5 intro-y h-full">
                <div class="flex flex-col items-start h-full lg:items-center">
                    {{-- Search Items --}}
                    <div class="relative ">
                        <input type="text" class="form-control py-3 px-4 w-full box pr-10 border-slate-500"
                            placeholder="Cari lahan...">
                        <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0 text-slate-500" data-lucide="search"></i>
                    </div>
                    <div
                        class="grow border-t border-b w-full border-slate-300 dark:border-darkmode-400 mt-6 mb-5 py-3 lg:overflow-hidden">
                        @if (count($seluruhLahan) > 0)
                            {{-- Below Large Screen --}}
                            <div class="block lg:hidden mx-6 pb-8">
                                <div class="responsive-mode">
                                    @include('pages.lahan.lokasi-lahan')
                                </div>
                            </div>

                            {{-- Large Screen and Above --}}
                            <div class="hidden lg:block overflow-y-auto scrollbar-hidden max-h-[calc(70vh-160px)]">
                                <div class="flex flex-col gap-2">
                                    @include('pages.lahan.lokasi-lahan')
                                </div>
                            </div>
                        @else
                            {{-- Lahan Kosong --}}
                            <div class="flex flex-col items-center justify-center text-center h-full">
                                <p class="font-bold  p-2">
                                    Tidak ada lahan
                                </p>
                                <p class="font-medium mb-2">Silahkan tambahkan lahan terlebih dahulu</p>
                                <a href="{{ route('lahan.create') }}" class="btn bg-rgb-secondary text-white shadow-md">
                                    <i class="fa-solid fa-circle-plus mr-2"></i>Tambah Lahan
                                </a>
                            </div>
                        @endif
                    </div>
                    <div>
                        Tekan lahan untuk menunjukkan lokasi pada peta
                    </div>
                </div>
            </div>
        </div>
        {{-- Masukin maps di sini --}}
        @include('pages.lahan.maps')
    </div>
@endsection

@include('pages.lahan.scripts')
