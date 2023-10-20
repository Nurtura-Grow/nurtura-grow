@extends('layout.side-menu')

@section('subcontent')
    {{-- Atas --}}
    <div class="grid grid-cols-12 gap-6 2xl:border-b-2 mb-5 pb-10">
        {{-- Kiri --}}
        <div class="col-span-12 2xl:col-span-9">
            <div class="grid grid-cols-12 gap-6 ">
                {{-- Grafik Sensor Terkini --}}
                <div class="col-span-12 mt-2">
                    <div class="intro-y block sm:flex items-center h-10 mt-5">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Data Sensor Terkini
                        </h2>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        @for ($i = 1; $i <= 4; $i++)
                            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                <div class="report-box zoom-in">
                                    <div class="box p-5">
                                        {{-- Grafik 1 --}}
                                        <p>Grafik {{ $i }}</p>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
                {{-- Grafik Data Semua Sensor --}}
                <div class="col-span-12 mt-2">
                    <div class="intro-y block sm:flex items-center h-10 mt-5">
                        <h2 class="text-lg font-medium truncate mr-5">
                            Data Seluruh Sensor
                        </h2>
                        <a class="sm:ml-auto mt-3 sm:mt-0 relative btn btn-primary text-white" data-tw-toggle="modal"
                            data-tw-target="#datepicker-modal-preview">
                            Filter berdasarkan tanggal
                        </a>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 intro-y">
                            <div class="report-box">
                                <div class="box p-5">
                                    {{-- Grafik 1 --}}
                                    <p>Grafik {{ $i }}</p>
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
            <div class="2xl:border-l -mb-10 pb-10">
                <div class="2xl:pl-6 grid grid-cols-12 gap-x-6 2xl:gap-x-0 gap-y-6">
                    <!-- BEGIN: Hari Setelah Tanam -->
                    <div class="col-span-12 md:col-span-6 xl:col-span-4 2xl:col-span-12 mt-3 2xl:mt-8">
                        <div class="intro-x flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                Hari Setelah Tanam
                            </h2>
                        </div>
                        <div class="mt-5">
                            @for ($i = 1; $i <= 4; $i++)
                                <div class="intro-x">
                                    <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                        <div class="ml-4 mr-auto">
                                            <div class="font-medium">Penanaman {{ $i }}</div>
                                            <div class="text-slate-500 text-xs mt-0.5">3 June 2020</div>
                                        </div>
                                        <div class="text-success">+$36</div>
                                    </div>
                                </div>
                            @endfor

                            <a href="#"
                                class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-slate-400 dark:border-darkmode-300 text-slate-500">Lihat
                                Selengkapnya</a>
                        </div>
                    </div>
                    <!-- END: Hari Setelah Tanam -->
                </div>
            </div>
        </div>

    </div>

    {{-- Bawah --}}
    <div class="grid grid-cols-12 gap-6">
        {{-- Daftar Lahan --}}
        <div class="col-span-12 2xl:col-span-6">
            <div class="col-span-12">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Daftar Lahan
                    </h2>
                    <div class="sm:ml-auto mt-3 sm:mt-0 relative text-slate-500">
                        <i class="fa-solid fa-location-dot w-4 h-4 z-10 absolute my-auto inset-y-0 ml-3 left-0"></i>
                        <input type="text" class="form-control sm:w-56 box pl-10" placeholder="Filter lokasi lahan">
                    </div>
                </div>
                <div class="intro-y box p-5 mt-12 sm:mt-5">
                    <div class="report-maps mt-5 bg-slate-200 rounded-md">
                        {{-- Todo: tambahin maps --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- Riwayat Aksi --}}
        <div class="col-span-12 2xl:col-span-6">
            <div class="col-span-12">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Riwayat Aksi
                    </h2>
                    <a href="#" class="sm:ml-auto mt-3 sm:mt-0 relative text-primary">
                        Lihat Selengkapnya
                    </a>
                </div>
                <div class="intro-y box p-5 mt-12 sm:mt-5">

                    <div class="report-maps mt-5 rounded-md">
                        <table>
                            <thead>Halo</thead>
                            <tr>
                                <td>10</td>
                            </tr>
                        </table>
                    </div>
                    {{-- Todo: benerin table pake tabulator (?) --}}

                </div>
            </div>
        </div>
    </div>
    @include('pages.components.modal-datepicker')
@endsection
