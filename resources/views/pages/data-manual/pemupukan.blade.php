@extends('layout.side-menu')

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Manual Pemupukan
        </h2>
    </div>

    <div class="intro-y box p-5 mt-5">
        <div class="overflow-x-auto scrollbar-hidden">
            <form>
                @include('pages.data-manual.nama-lahan')

                <div class="form-inline mt-5">
                    <label for="volume_pemupukan" class="form-label sm:w-48">Volume Pemupukan</label>
                    <div class="input-group w-56">
                        <input name="volume_pemupukan" type="text" class="form-control" placeholder="10">
                        <div class="input-group-text">ml</div>
                    </div>
                </div>

                <div class="form-inline mt-5">

                    <label for="tanggal_pemupukan" class="form-label sm:w-48">Tanggal Pemupukan</label>
                    <div class="relative w-56">
                        <div
                            class="absolute top-0 left-0 rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500">
                            <i class="fa-solid fa-calendar w-4 h-4"></i>
                        </div>
                        <input name="tanggal_pemupukan" type="text" class="form-control datepicker pl-12"
                            data-single-mode=true>
                    </div>
                </div>

                <div class="form-inline mt-5">
                    <label for="waktu" class="form-label sm:w-48">Waktu</label>
                    <div class="flex flex-col lg:flex-row gap-2">
                        {{-- Waktu Mulai --}}
                        <div class="relative w-56">
                            <div
                                class="absolute top-0 left-0 rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500">
                                <i class="fa-regular fa-clock w-4 h-4"></i>
                            </div>
                            <input type="text" class="form-control waktu-mulai pl-12" placeholder="Waktu Mulai"
                                aria-label="waktu" name="waktu_mulai">
                        </div>
                        {{-- Waktu Selesai --}}
                        <div class="relative w-56">
                            <div
                                class="absolute top-0 left-0 rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500">
                                <i class="fa-regular fa-clock w-4 h-4"></i>
                            </div>
                            <input type="text" class="form-control waktu-selesai pl-12" placeholder="Waktu Selesai"
                                aria-label="waktu" name="waktu_selesai">
                        </div>
                    </div>
                </div>

                <div class="sm:ml-48 sm:pl-5">
                    <button type="submit" class="btn btn-primary mt-5 px-10">Masukkan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@include('pages.data-manual.scripts')
