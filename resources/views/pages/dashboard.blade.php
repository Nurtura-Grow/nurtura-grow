@extends('layout.side-menu')

@section('subcontent')
    {{-- Atas --}}
    <div class="grid grid-cols-12 gap-6 2xl:border-b-2 mb-5 pb-10 border-slate-300">
        {{-- Kiri --}}
        <div class="col-span-12 2xl:col-span-9">
            <div class="flex flex-col max-xl:min-h-[120vh] xl:min-h-screen 2xl:min-h-0 h-full">
                {{-- Grafik Sensor Terkini --}}
                <div class="basis-[60%] xl:basis-[40%] 2xl:basis-2/5 mt-2 flex flex-col">
                    {{-- Container Item --}}
                    <div class="intro-y block sm:flex items-center h-10 mt-5">
                        {{-- Judul --}}
                        <h2 class="text-lg font-medium truncate mr-5">
                            Data Sensor Terkini
                        </h2>

                        <p class="sm:ml-auto relative font-bold">
                            {{ $timestamp }}
                        </p>
                    </div>
                    {{-- Container Grafik (grow = h-full) --}}
                    <div class="intro-y grow flex flex-wrap -mx-4 mt-4">
                        @foreach ($grafik as $graf)
                            <div class="w-full sm:w-1/2 xl:w-1/4 px-4 mb-6">
                                <div class="report-box h-full zoom-in">
                                    <div class="box p-5 h-full text-center">
                                        {{-- Judul Grafik --}}
                                        <p class="mb-2 font-semibold">{{ $graf['name'] }}</p>
                                        {{-- Isi Grafik --}}
                                        <div class="radial-progress"
                                            style="color:{{ $graf['color'] }}; --value:{{ $graf['data'] }}; --thickness:1rem;"
                                            role="progressbar">
                                            <span class='text-rgb-dark font-semibold text-xl whitespace-nowrap'>
                                                {{ $graf['data'] }}{{ Str::contains($graf['slug'], 'kelembapan') ? '%' : (Str::contains($graf['slug'], 'suhu') ? '°C' : '') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Grafik Data Semua Sensor --}}
                <div class="basis-[40%] xl:basis-[60%] 2xl:basis-3/5 mt-2 flex flex-col">
                    {{-- Judul --}}
                    <div class="intro-y block sm:flex items-center h-10 mt-3">
                        <h2 class="text-lg font-medium truncate mr-auto">
                            Data Seluruh Sensor
                        </h2>
                        <div class="flex flex-row mt-3 sm:mt-0">
                            <div class="w-40 sm:w-56 lg:w-64">
                                <select data-placeholder="Pilih grafik yang ditunjukkan" id="pilihGrafik"
                                    class="tom-select w-full">
                                    @foreach ($grafik as $graf)
                                        <option>{{ $graf['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <a class="ml-1 sm:ml-5 relative btn btn-primary text-white" data-tw-toggle="modal"
                                data-tw-target="#datepicker-modal-preview">
                                Pilih tanggal
                            </a>
                        </div>
                    </div>
                    {{-- Contaier Grafik --}}
                    <div class="intro-y grow -mx-4 mt-12 sm:mt-5">
                        <div class="px-4 mb-4 h-full">
                            <div class="report-box h-full zoom-in">
                                <div class="box p-5 h-full flex items-center justify-center">
                                    {{-- Isi Grafik Keseluruhan --}}
                                    <canvas class="w-fit h-fit" id="grafik-keseluruhan"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End: Grafik Data Semua Sensor --}}
            </div>
        </div>

        {{-- Kanan --}}
        <div class="col-span-12 2xl:col-span-3">
            <div class="2xl:border-l h-full border-slate-300 -mb-10 pb-10">
                <div class="2xl:pl-6 grid grid-cols-12 gap-x-6 2xl:gap-x-0 gap-y-6">
                    <!-- BEGIN: Hari Setelah Tanam -->
                    <div class="col-span-12  2xl:col-span-12 mt-3 2xl:mt-8">
                        {{-- Judul --}}
                        <div class="intro-x flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                Hari Setelah Tanam
                            </h2>
                        </div>

                        {{-- Cotainer kotak-kotak --}}
                        <div class="mt-3 grid grid-cols-12 2xl:gap-0 md:gap-6">
                            {{-- Pengulangan Kotak sebanyak 4 kali --}}
                            @for ($i = 0; $i < $jumlahLahan; $i++)
                                <div class="col-span-12 2xl:col-span-12 md:col-span-6 intro-y mt-0">
                                    <div
                                        class="intro-x box {{ isset($penanaman[$i]) ? 'px-5 py-3' : 'flex flex-col justify-center items-center' }} mb-3 zoom-in min-h-[100px]">
                                        @if (isset($penanaman[$i]))
                                            {{-- Kalau penanamannya ada --}}
                                            <div class=" ml-1 mr-auto">
                                                {{-- Judul Penanaman --}}
                                                <div class="font-bold text-rgb-secondary">
                                                    {{ Str::limit($penanaman[$i]->nama_penanaman, 20, '...') }}
                                                </div>
                                                {{-- Tanggal Tanam --}}
                                                <div class="text-slate-500 text-xs mt-0.5">
                                                    {{ $penanaman[$i]->tanggal_tanam }}
                                                </div>
                                                {{-- Progress Bar --}}
                                                <div class="progress mt-2 h-4">
                                                    <div class="progress-bar" aria-valuenow="0" aria-valuemin="0"
                                                        aria-valuemax="100" role="progressbar"
                                                        style="width: {{ $penanaman[$i]->persentase }}%;">
                                                    </div>
                                                </div>
                                                {{-- Keterangan Progress --}}
                                                <div class="flex justify-between text-dark">
                                                    <div class="text-xs  mt-1"><span
                                                            class="text-rgb-primary">{{ $penanaman[$i]->hst }}</span>/{{ $penanaman[$i]->default_hari }}
                                                        hari</div>
                                                    <div class="text-xs mt-1">{{ $penanaman[$i]->persentase }}%
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            {{-- Kalau gaada --}}
                                            <p class="text-rgb-secondary font-semibold">Tidak Ada Data
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            @endfor
                        </div>

                        {{-- Lihat Selegkapnya --}}
                        <a href="{{ route('tanaman.index') }}"
                            class="intro-x w-full block mt-2 text-center rounded-md py-3 border border-dotted border-slate-400 bg-rgb-secondary text-white">Lihat
                            Selengkapnya</a>
                    </div>
                    <!-- END: Hari Setelah Tanam -->
                </div>
            </div>
        </div>

    </div>

    {{-- Bawah --}}
    <div class="grid grid-cols-12 gap-6">
        {{-- Daftar Lahan --}}
        <div class="col-span-12 2xl:col-span-6 flex flex-col">
            <div class="col-span-12 flex flex-col h-full">
                <div class="intro-y block sm:flex items-center h-10">
                    {{-- Judul Daftar Lahan --}}
                    <h2 class="text-lg font-medium truncate mr-5">
                        Daftar Lahan
                        <a href="{{ route('lahan.index') }}" class="text-primary font-normal">(Lihat Selengkapnya)</a>
                    </h2>
                    {{-- Fitur Search --}}
                    <div class="sm:ml-auto mt-3 sm:mt-0 relative text-slate-500">
                        <i class="fa-solid fa-location-dot w-4 h-4 z-10 absolute my-auto inset-y-0 ml-3 left-0"></i>
                        <input type="text" class="form-control sm:w-56 box pl-10" placeholder="Cari Lokasi"
                            id="cari-lokasi">
                    </div>
                </div>

                {{-- Maps --}}
                <div class="intro-y box p-5 mt-12 sm:mt-5 grow">
                    <div class="max-2xl:min-h-[500px] h-full" id="container-maps"></div>
                </div>
            </div>
        </div>

        {{-- Riwayat Aksi --}}
        <div class="col-span-12 2xl:col-span-6 flex flex-col">
            <div class="col-span-12 flex flex-col h-full">
                {{-- Judul Riwayat --}}
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Riwayat Aksi
                    </h2>
                    <a href="{{ route('riwayat.index') }}" class="sm:ml-auto mt-3 sm:mt-0 relative text-primary">
                        Lihat Selengkapnya
                    </a>
                </div>
                {{-- Isi Riwayat (Refer to riwayat pengairan) --}}
                <div class="intro-y box p-5 mt-12 sm:mt-5 grow">
                    <div class="rounded-md">
                        <div class="overflow-x-auto scrollbar-hidden">
                            @include('pages.riwayat.pengairan')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.components.modal-datepicker')
@endsection

@push('scripts')
    <script>
        var urlDashboard = "{{ route('dashboard.data') }}";
    </script>

    @vite(['resources/js/pages/dashboard/chart.js'])
@endpush
@include('pages.components.datatable-styles')
@include('pages.lahan.scripts')
