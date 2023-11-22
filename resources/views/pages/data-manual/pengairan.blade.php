@extends('layout.side-menu')

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Manual Pengairan
        </h2>
    </div>

    <div class="intro-y box p-5 mt-5 md:min-h-[40vh] lg:min-h-[70vh]">
        <form method="POST" action="{{ route('manual.pengairan.store') }}">
            @csrf
            @include('pages.data-manual.components.nama-lahan-pengairan-pemupukan')

            {{-- Tanggal Pengairan --}}
            <div class="form-inline mt-5">
                <label for="tanggal_pengairan" class="form-label sm:w-32">Tanggal Pengairan</label>
                <div class="relative w-56">
                    <div
                        class="absolute top-0 left-0 rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500">
                        <i class="fa-solid fa-calendar w-4 h-4"></i>
                    </div>
                    <input name="tanggal_pengairan" type="text" class="form-control pl-12" value="{{ $tanggalSekarang }}"
                        readonly>
                </div>
            </div>


            {{-- Volume/Durasi --}}
            <div class="form-inline mt-5">
                <label for="tanggal_pengairan" class="form-label sm:w-32">Volume air/durasi penyiraman alat</label>
                <div class="w-full">
                    {{-- Pengairan --}}
                    <div class="clickable-box flex flex-row mt-2 py-3 px-4 border-2 rounded-lg shadow-md">
                        <input class="form-check-input input-pengairan" type="radio" name="pengairan" checked>
                        <div>
                            <label class="form-check-label ml-4" for="volume_pengairan">Volume Pengairan</label>

                            <div class="grid grid-cols-12 gap-2 w-auto sm:w-56 ml-4 mt-2">
                                <input name="volume_pengairan" type="text" class="form-control col-span-6"
                                    placeholder="10">
                                <select class="form-select col-span-6" name="satuan">
                                    <option>L</option>
                                    <option selected>mL</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Waktu Pengairan --}}
                    <div class="clickable-box flex flex-row mt-5 py-3 px-4 border-2 rounded-lg shadow-md">
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
        </form>
    </div>
@endsection

@include('pages.data-manual.components.scripts')
