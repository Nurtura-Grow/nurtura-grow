@extends('layout.side-menu')

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Manual Tinggi Tanaman
        </h2>
    </div>

    <div class="intro-y box p-5 mt-5">
        <div class="overflow-x-auto scrollbar-hidden">
            <form>
                @include('pages.data-manual.nama-lahan')


                <div class="form-inline mt-5">
                    <label for="tanggal_pengairan" class="form-label sm:w-48">Tanggal Pencatatan</label>
                    <div class="relative w-56">
                        <div
                            class="absolute top-0 left-0 rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500">
                            <i class="fa-solid fa-calendar w-4 h-4"></i>
                        </div>
                        <input name="tanggal_pengairan" type="text" class="form-control datepicker pl-12"
                            data-single-mode=true>
                    </div>
                </div>

                <div class="form-inline mt-5">
                    <label for="tinggi_tanaman" class="form-label sm:w-48">Tinggi Tanaman</label>
                    <div class="input-group w-56">
                        <input name="tinggi_tanaman" type="text" class="form-control" placeholder="10">
                        <div class="input-group-text">cm</div>
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
