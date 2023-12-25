@extends('layout.side-menu')

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8 hidden" id="judul-section-sop">
        <h2 class="text-lg font-medium mr-auto">
            SOP Pengairan
        </h2>

        <div class="w-full sm:w-auto flex mt-4 sm:mt-0" id="sembunyikan-section-rekomendasi">
            <button class="btn bg-rgb-secondary text-white shadow-md">
                <i class="fa-regular fa-eye-slash mr-2"></i>Sembunyikan Rekomendasi dan SOP Pengairan
            </button>
        </div>
    </div>

    {{-- Form Input Manual Pengairan --}}
    <div class="intro-y flex flex-col sm:flex-row items-center mt-5" id="input-manual">
        <h2 class="text-lg font-medium mr-auto">
            Mengubah Pengairan Manual
        </h2>
    </div>
    <div class="intro-y box p-5 mt-5 md:min-h-[40vh] lg:min-h-[70vh]">
        <form method="POST"
            action="{{ route('manual.pengairan.update', ['pengairan' => $irrigation_controller->id_irrigation_controller]) }}">
            @method('PUT')
            @csrf

            <div class="form-inline">
                <label for="nama_penanaman" class="form-label sm:w-32">Nama Penanaman</label>
                <input type="text" class="form-control" name="durasi"
                    value="{{ $irrigation_controller->nama_penanaman }}" readonly>
            </div>

            {{-- Tanggal Pengairan --}}
            <div class="form-inline mt-5">
                <label for="tanggal_pengairan" class="form-label sm:w-32">Tanggal Pengairan</label>
                <div class="relative w-56">
                    <div
                        class="absolute top-0 left-0 rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500">
                        <i class="fa-solid fa-calendar w-4 h-4"></i>
                    </div>
                    <input name="tanggal_pengairan" type="text" class="form-control pl-12"
                        value="{{ $irrigation_controller->tanggal_pengairan }}" readonly>
                </div>
            </div>

            {{-- Volume/Durasi --}}
            <div class="form-inline mt-5">
                <label for="tanggal_pengairan" class="form-label sm:w-32">Volume air/durasi penyiraman alat</label>
                <div class="w-full">
                    {{-- Volume Pengairan --}}
                    <div class="clickable-box flex flex-row mt-2 ml-4 py-3 px-4 border-2 rounded-lg shadow-md">
                        <input class="form-check-input input-pengairan" type="radio" name="pengairan" checked>
                        <div>
                            <label class="form-check-label ml-4" for="volume_pengairan">Volume Pengairan</label>

                            <div class="grid grid-cols-12 gap-2 w-auto sm:w-56 ml-4 mt-2">
                                <input name="volume_pengairan" type="text" class="form-control col-span-6"
                                    placeholder="10" id="volume" value="{{ $irrigation_controller->volume_liter }}">
                                <select class="form-select col-span-6" name="satuan" id="satuan">
                                    <option selected>L</option>
                                    <option>mL</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Waktu Pengairan --}}
                    <div class="clickable-box flex flex-row mt-5 ml-4 py-3 px-4 border-2 rounded-lg shadow-md">
                        <input class="form-check-input input-pengairan" type="radio" name="pengairan">
                        <div>
                            <label class="form-check-label ml-4" for="waktu_pengairan">Waktu Pengairan</label>
                            <div class="flex flex-col lg:flex-row gap-2 ml-4 mt-2">
                                {{-- Waktu Mulai --}}
                                <div class="relative w-auto sm:w-56">
                                    <div
                                        class="absolute top-0 left-0 rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500">
                                        <i class="fa-regular fa-clock w-4 h-4"></i>
                                    </div>
                                    <input type="text" class="form-control waktu-mulai pl-12" id="waktu_mulai"
                                        placeholder="Waktu Mulai" aria-label="waktu" name="waktu_mulai"
                                        value="{{ $irrigation_controller->waktu_mulai }}">
                                </div>
                                {{-- Waktu Selesai --}}
                                <div class="relative w-auto sm:w-56">
                                    <div
                                        class="absolute top-0 left-0 rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500">
                                        <i class="fa-regular fa-clock w-4 h-4"></i>
                                    </div>
                                    <input type="text" class="form-control waktu-selesai pl-12" id="waktu_selesai"
                                        placeholder="Waktu Selesai" aria-label="waktu" name="waktu_selesai"
                                        value="{{ $irrigation_controller->waktu_selesai }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Durasi --}}
            <div class="form-inline mt-5">
                <label for="durasi" class="form-label sm:w-32">Durasi</label>
                <input type="text" class="form-control" name="durasi"
                    value="{{ $irrigation_controller->durasi_detik / 60 }} menit" id="durasi" readonly>
            </div>

            {{-- Keterangan --}}
            <div class="form-inline mt-5">
                <label class="form-label sm:w-32 font-bold" for="keterangan">Keterangan</label>
                <ul>
                    <li>
                        Volume akan menyesuaikan debit pengairan (kelipatan 7 sebelumnya)
                    </li>
                    <li>
                        Waktu pengairan <span class="font-bold">maksimal 180 menit</span>
                    </li>
                    <li>
                        Debit sprinkler: <span class="font-bold">7 L/menit</span>
                    </li>
                </ul>
            </div>

            {{-- Button Jalankan --}}
            <div class="sm:ml-32 sm:pl-5">
                <button type="submit" class="btn btn-primary mt-5 px-10 w-auto sm:w-56" id="submit" disabled>Ubah
                    Data</button>
            </div>
        </form>
    </div>
@endsection

@include('pages.data-manual.components.scripts')
@include('pages.components.modal-datepicker')

@push('scripts')
    <script>
        let urlDashboard = '{{ route('dashboard.data') }}'
    </script>

    @vite(['resources/js/pages/dashboard/litepickr.js', 'resources/js/pages/data-manual/pengairan-pemupukan.js', 'resources/js/pages/data-manual/pengairan.js'])
@endpush
