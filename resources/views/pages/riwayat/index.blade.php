@extends('layout.side-menu')

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-5 sm:mt-8 h-10">
        <h2 class="text-lg font-medium  mr-auto" id="judulHalaman">
            Riwayat Tinggi Tanaman
        </h2>
        <div class="w-full sm:w-auto flex mt-2 sm:mt-0"  id="buttonTambah">
            <a href="{{ route('manual.tinggi.create') }}" class="btn bg-rgb-secondary text-white shadow-md">
                <i class="fa-solid fa-circle-plus mr-2"></i>Tambah Tinggi Tanaman
            </a>
        </div>

        <div class="dropdown w-full sm:w-auto flex mt-2 sm:mt-0 hidden" id="dropdownTambah">
            <button class="dropdown-toggle btn bg-rgb-secondary text-white shadow-md" aria-expanded="false" data-tw-toggle="dropdown">
                <i class="fa-solid fa-circle-plus mr-2"></i>Tambahkan aksi
            </button>
            <div class="dropdown-menu w-40">
                <ul class="dropdown-content">
                    <li> <a href="{{ route('manual.pengairan.create')}}" class="dropdown-item">Pengairan</a> </li>
                    <li> <a href="{{ route('manual.pemupukan.create')}}" class="dropdown-item">Pemupukan</a> </li>
                </ul>
            </div>
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

                <li id="aksi-alat" class="nav-item flex-1" role="presentation">
                    <button class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#aksi-alat" type="button"
                        role="tab" aria-controls="aksi-alat" aria-selected="false"> Aksi Alat </button>
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

                <div id="aksi-alat" class="tab-pane leading-relaxed w-full sm:p-2" role="tabpanel"
                    aria-labelledby="aksi-alat">
                    @include('pages.riwayat.aksi-alat')
                </div>
            </div>
        </div>
    </div>
@endsection

@include('pages.components.datatable-styles')
@push('scripts')
    <script>
        const routeTinggi = "{{ route('manual.tinggi.create') }}"
    </script>

    @vite(['resources/js/pages/riwayat/index.js', 'resources/js/pages/riwayat/data-sensor.js', 'resources/js/pages/riwayat/litepicker.js'])
@endpush
