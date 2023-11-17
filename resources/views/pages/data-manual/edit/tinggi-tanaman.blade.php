@extends('layout.side-menu')

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Manual Tinggi Tanaman
        </h2>
    </div>

    <div class="intro-y box p-5 mt-5 md:min-h-[40vh] lg:min-h-[70vh]">
        <form method='POST' action="{{ route('manual.tinggi.update', ['tinggi' => $tanaman->id_tinggi_tanaman]) }}">
            @csrf
            @method('PATCH')
            @include('pages.data-manual.components.nama-lahan')

            <div class="form-inline mt-5">
                <label for="tanggal_pencatatan" class="form-label sm:w-32">Tanggal Pencatatan</label>
                <div class="relative w-56">
                    <div
                        class="absolute top-0 left-0 rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500">
                        <i class="fa-solid fa-calendar w-4 h-4"></i>
                    </div>
                    <input name="tanggal_pencatatan" type="text" class="form-control dateTinggi pl-12"
                        data-single-mode="true" value="{{ $tanaman->tanggal_pengukuran }}">
                </div>
            </div>

            <div class="form-inline mt-5">
                <label for="tinggi_tanaman" class="form-label sm:w-32">Tinggi Tanaman</label>
                <div class="grid grid-cols-12 gap-2 w-56">
                    <input name="tinggi_tanaman" type="text" class="form-control col-span-6" placeholder="10"
                        value="{{ $tanaman->tinggi_tanaman_mm }}" id="tinggi_tanaman">
                    <select class="form-select col-span-6" name="satuan" id="satuan">
                        <option>cm</option>
                        <option selected>mm</option>
                    </select>
                </div>
            </div>

            <div class="sm:ml-32 sm:pl-5">
                <button type="submit" class="btn btn-primary mt-5 px-10">Ubah</button>
                <a href="{{ route('riwayat.index') }}" class="btn bg-white ml-2 px-10">Batal</a>
            </div>
        </form>
    </div>
@endsection

@include('pages.data-manual.components.scripts')
