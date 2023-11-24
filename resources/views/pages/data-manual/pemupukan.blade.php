@extends('layout.side-menu')

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8 hidden" id="judul-section-sop">
        <h2 class="text-lg font-medium mr-auto">
            SOP Pengairan
        </h2>

        <div class="w-full sm:w-auto flex mt-4 sm:mt-0" id="sembunyikan-section-rekomendasi">
            <button class="btn bg-rgb-secondary text-white shadow-md">
                <i class="fa-regular fa-eye-slash mr-2"></i>Sembunyikan Rekomendasi dan SOP Pemupukan
            </button>
        </div>
    </div>

    {{-- Rekomendasi Pemupukan --}}
    <div class="flex flex-col min-h-[68vh] mt-5 gap-4 hidden" id="section-rekomendasi">
        <div class="intro-y grow basis-1/2 box p-5">
            {{-- Todo: Add Gambar SOP Pemupukan --}}
        </div>

        {{-- Bawah --}}
        <div class="grow basis-1/2 flex flex-col lg:flex-row gap-5 mb-8">
            <div class="basis-1/2">
                <h3 class="intro-y font-medium text-lg mb-3">Grafik Terkini</h3>
                <div class="intro-y h-full box p-5">
                    {{-- Grafik Pemupukan --}}
                </div>
            </div>

            {{-- Aksi Pemupukan --}}
            <div class="basis-1/2">
                <h3 class="intro-y font-medium text-lg mb-3">Aksi Pemupukan</h3>

                <div class="intro-y h-full box p-5 flex flex-col justify-around gap-4">
                    {{-- Kondisi Tanaman Saat ini --}}
                    <div class="intro-y flex flex-col gap-2">
                        <p><i class="fa-solid fa-seedling mr-3" style="color: #00854b;"></i>
                            Kondisi tanaman Anda saat ini:
                        </p>
                        {{-- Kondisi Tanaman --}}
                        <span
                            class="shrink px-3 py-2 font-bold rounded-full bg-primary text-white text-center text-lg shadow-md tracking-[.3em]">IDEAL</span>
                    </div>

                    {{-- Pemupukan Terakhir --}}
                    <div class="intro-y">
                        <p class="font-bold">Pemupukan Terakhir</p>
                        <span class="">31 Desember 2023</span>

                        <div class="flex mt-2">
                            <span class="basis-1/6">Pukul:</span>
                            <span>12:00:00 - 12:15:00</span>
                        </div>
                        <div class="flex">
                            <span class="basis-1/6">Volume:</span>
                            <span>100 mL</span>
                        </div>
                    </div>

                    {{-- Rekomendasi Pemupukan Selanjutnya --}}
                    <div class="intro-y">
                        <p class="font-bold">Rekomendasi Pemupukan Selanjutnya</p>
                        <span class="">31 Desember 2023</span>

                        <div class="flex mt-2">
                            <span class="basis-1/6">Pukul:</span>
                            <span>12:00:00 - 12:15:00</span>
                        </div>
                        <div class="flex">
                            <span class="basis-1/6">Volume:</span>
                            <span>100 mL</span>
                        </div>
                    </div>

                    {{-- Aksi Pemupukan --}}
                    <div class="intro-y" id="jalankan-aksi-sekarang">
                        <p class="mb-2 font-bold">Apakah Anda ingin memberi pupuk sekarang?</p>
                        <div class="flex flex-row gap-2">
                            <a href="#input-manual" class="basis-1/2 w-full btn btn-primary px-5">Ya, abaikan rekomendasi
                                sistem</a>
                            <a href="#judul-section-sop" class="basis-1/2 w-full btn px-5" id="jalankan-rekomendasi">Tidak, ikuti
                                rekomendasi
                                sistem</a>
                        </div>
                    </div>

                    <div class="intro-y hidden" id="rekomendasi-sistem">
                        <p class="font-semibold">Pemupukan akan dilaksanakan <span class="text-slate-400">sesuai
                                rekomendasi sistem</span>
                            <i class="fa-solid fa-face-smile-wink text-warning"></i>
                        </p>
                        <button class="btn border-2 shadow-md p-3 w-full mt-2" id="batalkan">Batalkan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Form Input Manual Pemupukan --}}
    <div class="intro-y flex flex-col sm:flex-row items-center mt-5" id="input-manual">
        <h2 class="text-lg font-medium mr-auto">
            Input Manual Pemupukan
        </h2>

        <div class="w-full sm:w-auto flex mt-4 sm:mt-0" id="button-tampilkan-sop">
            <button class="btn bg-rgb-secondary text-white shadow-md">
                <i class="fa-solid fa-eye mr-2"></i>Tampilkan SOP dan Rekomendasi Pemupukan
            </button>
        </div>
    </div>
    <div class="intro-y box p-5 mt-5 md:min-h-[40vh] lg:min-h-[70vh]">
        <form method="POST" action="{{ route('manual.pemupukan.store') }}">
            @csrf
            @include('pages.data-manual.components.nama-lahan-pengairan-pemupukan')

            {{-- Tanggal pemupukan --}}
            <div class="form-inline mt-5">
                <label for="tanggal_pemupukan" class="form-label sm:w-32">Tanggal Pemupukan</label>
                <div class="relative w-56">
                    <div
                        class="absolute top-0 left-0 rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500">
                        <i class="fa-solid fa-calendar w-4 h-4"></i>
                    </div>
                    <input name="tanggal_pemupukan" type="text" class="form-control pl-12" value="{{ $tanggalSekarang }}"
                        readonly>
                </div>
            </div>


            {{-- Volume/Durasi --}}
            <div class="form-inline mt-5">
                <label for="tanggal_pemupukan" class="form-label sm:w-32">Volume/durasi pemupukan alat</label>
                <div class="w-full">
                    {{-- Pemupukan --}}
                    <div class="clickable-box flex flex-row mt-2 py-3 px-4 border-2 rounded-lg shadow-md">
                        <input class="form-check-input input-pemupukan" type="radio" name="pemupukan" checked>
                        <div>
                            <label class="form-check-label ml-4" for="volume_pemupukan">Volume Pemupukan</label>

                            <div class="grid grid-cols-12 gap-2 w-auto sm:w-56 ml-4 mt-2">
                                <input name="volume_pemupukan" type="text" class="form-control col-span-6"
                                    placeholder="10">
                                <select class="form-select col-span-6" name="satuan">
                                    <option>L</option>
                                    <option selected>mL</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Waktu pemupukan --}}
                    <div class="clickable-box flex flex-row mt-5 py-3 px-4 border-2 rounded-lg shadow-md">
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
                                        aria-label="waktu" name="waktu_mulai">
                                </div>
                                {{-- Waktu Selesai --}}
                                <div class="relative w-auto sm:w-56">
                                    <div
                                        class="absolute top-0 left-0 rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500">
                                        <i class="fa-regular fa-clock w-4 h-4"></i>
                                    </div>
                                    <input type="text" class="form-control waktu-selesai pl-12"
                                        placeholder="Waktu Selesai" aria-label="waktu" name="waktu_selesai">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Button Submit --}}
            <div class="sm:ml-32 sm:pl-5">
                <button type="submit" class="btn btn-primary mt-5 px-10">Masukkan</button>
            </div>

            {{-- Warning --}}
            <div class="sm:ml-32 sm:pl-5 mt-3">
                <span class="text-warning">
                    <span class="font-bold">
                        <i class="fa-solid fa-triangle-exclamation mr-3"></i>PERINGATAN<i
                            class="fa-solid fa-triangle-exclamation ml-3"></i>
                        <br>
                    </span>
                    Aksi Anda akan menggantikan rekomendasi sistem.
                </span>
            </div>
        </form>
    </div>
@endsection

@include('pages.data-manual.components.scripts')

@push('scripts')
    @vite(['resources/js/pages/data-manual/pengairan.js'])
@endpush
