@extends('layout.side-menu')

@section('subcontent')
    {{-- Atas --}}
    <div class="grid grid-cols-12 gap-6 2xl:border-b-2 mb-5 pb-10 border-slate-300">
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
                        <h2 class="text-lg font-medium truncate mr-5 sm:mr-0">
                            Data Seluruh Sensor
                        </h2>
                        <a class="sm:ml-auto mt-3 sm:mt-0 relative btn btn-primary text-white" data-tw-toggle="modal"
                            data-tw-target="#datepicker-modal-preview">
                            Pilih tanggal
                        </a>
                    </div>
                    <div class="grid grid-cols-12 mt-12 sm:mt-5 gap-6">
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
            <div class="2xl:border-l border-slate-300 -mb-10 pb-10">
                <div class="2xl:pl-6 grid grid-cols-12 gap-x-6 2xl:gap-x-0 gap-y-6">
                    <!-- BEGIN: Hari Setelah Tanam -->
                    <div class="col-span-12  2xl:col-span-12 mt-3 2xl:mt-8">
                        <div class="intro-x flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">
                                Hari Setelah Tanam
                            </h2>
                        </div>
                        <div class="mt-5">
                            <div class="grid grid-cols-12 2xl:gap-0 md:gap-6">
                                @for ($i = 1; $i <= 4; $i++)
                                    <div class="col-span-12 2xl:col-span-12 md:col-span-6 intro-y mt-0">
                                        <div class="intro-x">
                                            <div class="box px-5 py-3 mb-3  zoom-in">
                                                <div class=" ml-1 mr-auto">
                                                    <div class="font-bold text-rgb-secondary">Penanaman {{ $i }}
                                                    </div>
                                                    <div class="text-slate-500 text-xs mt-0.5">3 June 2020</div>
                                                    <div class="progress mt-2 h-4">
                                                        <div class="progress-bar w-1/2" role="progressbar" aria-valuenow="0"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <div class="flex justify-between text-dark">
                                                        <div class="text-xs  mt-1"><span
                                                                class="text-rgb-primary">10</span>/30 hari</div>
                                                        <div class="text-xs mt-1">50%</div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>

                            <a href="#"
                                class="intro-x w-full block mt-2 text-center rounded-md py-3 border border-dotted border-slate-400 dark:border-darkmode-300 bg-rgb-secondary text-white">Lihat
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
                <div class="intro-y box p-5 mt-12 sm:mt-5 h-full">
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
                    <a href="{{ route('riwayat.rekomendasi') }}" class="sm:ml-auto mt-3 sm:mt-0 relative text-primary">
                        Lihat Selengkapnya
                    </a>
                </div>
                <div class="intro-y box p-5 mt-12 sm:mt-5">
                    <div class="mt-5 rounded-md">
                        <div class="overflow-x-auto scrollbar-hidden">
                            <table id="table" class="hover table overflow-x-auto">
                                <thead>
                                    <tr>
                                        <th class="border-b-2 whitespace-nowrap">Name</th>
                                        <th class="border-b-2 whitespace-nowrap">Category</th>
                                        <th class="border-b-2 whitespace-nowrap">Remaining Stock</th>
                                    </tr>
                                </thead>
                                {{-- <tbody>
                                    @for ($i = 1; $i < 10; $i++)
                                        <tr>
                                            <td class="border-b">Item {{ $i }}</td>
                                            <td class="border-b">Category {{ $i }}</td>
                                            <td class="border-b">{{ $i * 10 }}</td>
                                        </tr>
                                    @endfor
                                </tbody> --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('pages.components.modal-datepicker')
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    @vite('resources/js/pages/datatable.js')
@endpush
