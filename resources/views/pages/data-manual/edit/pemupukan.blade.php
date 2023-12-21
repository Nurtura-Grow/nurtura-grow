@extends('layout.side-menu')

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8 hidden" id="judul-section-sop">
        <h2 class="text-lg font-medium mr-auto">
            SOP Pemupukan
        </h2>

        <div class="w-full sm:w-auto flex mt-4 sm:mt-0" id="sembunyikan-section-rekomendasi">
            <button class="btn bg-rgb-secondary text-white shadow-md">
                <i class="fa-regular fa-eye-slash mr-2"></i>Sembunyikan Rekomendasi dan SOP Pemupukan
            </button>
        </div>
    </div>

    {{-- Form Input Manual Pemupukan --}}
    <div class="intro-y flex flex-col sm:flex-row items-center mt-5" id="input-manual">
        <h2 class="text-lg font-medium mr-auto">
            Mengubah Pemupukan Manual
        </h2>
    </div>
    <div class="intro-y box p-5 mt-5 md:min-h-[40vh] lg:min-h-[70vh]">
        <form method="POST"
            action="{{ route('manual.pemupukan.update', ['pemupukan' => $fertilizer_controller->id_fertilizer_controller]) }}">
            @csrf
            <div class="form-inline">
                <label for="nama_penanaman" class="form-label sm:w-32">Nama Penanaman</label>
                <input type="text" class="form-control" name="durasi"
                    value="{{ $fertilizer_controller->nama_penanaman }}" readonly>
            </div>

            {{-- Tanggal pemupukan --}}
            <div class="form-inline mt-5">
                <label for="tanggal_pemupukan" class="form-label sm:w-32">Tanggal Pemupukan</label>
                <div class="relative w-56">
                    <div
                        class="absolute top-0 left-0 rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500">
                        <i class="fa-solid fa-calendar w-4 h-4"></i>
                    </div>
                    <input name="tanggal_pemupukan" type="text" class="form-control pl-12"
                        value="{{ $fertilizer_controller->tanggal_pemupukan }}" readonly>
                </div>
            </div>


            {{-- Volume/Durasi --}}
            <div class="form-inline mt-5">
                <label for="tanggal_pemupukan" class="form-label sm:w-32">Volume/durasi pemupukan alat</label>
                <div class="w-full">
                    {{-- Pemupukan --}}
                    <div class="clickable-box flex flex-row mt-2 py-3 px-4 ml-4 border-2 rounded-lg shadow-md">
                        <input class="form-check-input input-pemupukan" type="radio" name="pemupukan" checked>
                        <div>
                            <label class="form-check-label ml-4" for="volume_pemupukan">Volume Pemupukan</label>

                            <div class="grid grid-cols-12 gap-2 w-auto sm:w-56 ml-4 mt-2">
                                <input name="volume_pemupukan" type="text" class="form-control col-span-6"
                                    placeholder="10" value="{{ $fertilizer_controller->volume_liter }}" id="volume">
                                <select class="form-select col-span-6" name="satuan" id="satuan">
                                    <option selected>L</option>
                                    <option>mL</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Waktu pemupukan --}}
                    <div class="clickable-box flex flex-row mt-5 py-3 px-4 ml-4 border-2 rounded-lg shadow-md">
                        <input class="form-check-input input-pemupukan" type="radio" name="pemupukan">

                        <div>
                            <label class="form-check-label ml-4" for="waktu_pemupukan">Waktu Pemupukan</label>
                            <div class="flex flex-col lg:flex-row gap-2 ml-4 mt-2">
                                {{-- Waktu Mulai --}}
                                <div class="relative w-auto sm:w-56">
                                    <div
                                        class="absolute top-0 left-0 rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500">
                                        <i class="fa-regular fa-clock w-4 h-4"></i>
                                    </div>
                                    <input type="text" class="form-control waktu-mulai pl-12" placeholder="Waktu Mulai"
                                        aria-label="waktu" name="waktu_mulai"
                                        value="{{ $fertilizer_controller->waktu_mulai }}">
                                </div>
                                {{-- Waktu Selesai --}}
                                <div class="relative w-auto sm:w-56">
                                    <div
                                        class="absolute top-0 left-0 rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500">
                                        <i class="fa-regular fa-clock w-4 h-4"></i>
                                    </div>
                                    <input type="text" class="form-control waktu-selesai pl-12"
                                        placeholder="Waktu Selesai" aria-label="waktu" name="waktu_selesai"
                                        value="{{ $fertilizer_controller->waktu_selesai }}">
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
                    value="{{ $fertilizer_controller->durasi_detik / 60 }} menit"
                    placeholder="Pilih waktu mulai dan selesai untuk mendapatkan durasi" id="durasi" readonly>
            </div>


            {{-- Keterangan --}}
            <div class="form-inline mt-5">
                <label class="form-label sm:w-32 font-bold" for="keterangan">Keterangan</label>
                <ul>
                    <li>
                        Waktu pemupukan <span class="font-bold">maksimal 180 menit</span>
                    </li>
                    <li>
                        Debit sprinkler: <span class="font-bold">7 L/menit</span>
                    </li>
                </ul>
            </div>

            {{-- Button Jalankan --}}
            <div class="sm:ml-32 sm:pl-5">
                <button type="submit" class="btn btn-primary mt-5 px-10 w-auto sm:w-56" id="submit"
                    disabled>Jalankan</button>
            </div>
        </form>
    </div>
@endsection

@include('pages.data-manual.components.scripts')

@push('scripts')
    @vite(['resources/js/pages/data-manual/pengairan-pemupukan.js', 'resources/js/pages/data-manual/pemupukan.js'])
@endpush
