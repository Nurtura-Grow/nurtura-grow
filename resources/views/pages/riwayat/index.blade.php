@extends('layout.side-menu')

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-5 sm:mt-8 h-10">
        <h2 class="text-lg font-medium  mr-auto" id="judulHalaman">
            Riwayat Tinggi Tanaman
        </h2>
        <div class="w-full sm:w-auto flex mt-2 sm:mt-0">
            <a href="{{ route('manual.tinggi.create') }}" class="btn bg-rgb-secondary text-white shadow-md" id="buttonTambah">
                <i class="fa-solid fa-circle-plus mr-2"></i>Tambah Tinggi Tanaman
            </a>
        </div>
    </div>

    <div class="intro-y box p-5 mt-10 sm:mt-5">
        <div class="">
            <ul class="nav nav-link-tabs overflow-x-auto scrollbar-hidden" role="tablist" id="navigationBar">
                <li id="riwayat-tinggi" class="nav-item flex-1" role="presentation">
                    <button class="nav-link w-full py-2 active" data-tw-toggle="pill" data-tw-target="#tinggi"
                        type="button" role="tab" aria-controls="tinggi" aria-selected="true"> Tinggi Tanaman
                    </button>
                </li>

                <li id="riwayat-sensor" class="nav-item flex-1" role="presentation">
                    <button class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#data-sensor" type="button"
                        role="tab" aria-controls="data-sensor" aria-selected="false"> Data Sensor </button>
                </li>

                <li id="riwayat-pemupukan" class="nav-item flex-1" role="presentation">
                    <button class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#pemupukan" type="button"
                        role="tab" aria-controls="pemupukan" aria-selected="false"> Pemupukan </button>
                </li>

                <li id="riwayat-pengairan" class="nav-item flex-1" role="presentation">
                    <button class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#pengairan" type="button"
                        role="tab" aria-controls="pengairan" aria-selected="false"> Pengairan </button>
                </li>
            </ul>

            <div class="tab-content mt-5 w-full">
                <div id="tinggi" class="tab-pane leading-relaxed active w-full sm:p-2" role="tabpanel"
                    aria-labelledby="riwayat-tinggi">
                    @include('pages.riwayat.tinggi-tanaman')
                </div>
                <div id="data-sensor" class="tab-pane leading-relaxed w-full sm:p-2" role="tabpanel"
                    aria-labelledby="riwayat-sensor">
                    @include('pages.riwayat.data-sensor')
                </div>

                <div id="pemupukan" class="tab-pane leading-relaxed w-full sm:p-2" role="tabpanel"
                    aria-labelledby="riwayat-pemupukan">
                    @include('pages.riwayat.pemupukan')
                </div>
                <div id="pengairan" class="tab-pane leading-relaxed w-full sm:p-2" role="tabpanel"
                    aria-labelledby="riwayat-pengairan">
                    @include('pages.riwayat.pengairan')
                </div>
            </div>
        </div>
    </div>
@endsection

@include('pages.components.datatable-styles')
@push('scripts')
    <script>
        const routeTinggi = "{{ route('manual.tinggi.create') }}"
        const routePemupukan = "{{ route('manual.pemupukan.create') }}";
        const routePengairan = "{{ route('manual.pengairan.create') }}";
    </script>

    @vite(['resources/js/pages/riwayat/index.js', 'resources/js/pages/riwayat/data-sensor.js', 'resources/js/pages/riwayat/litepicker.js'])
@endpush
