@extends('layout.side-menu')

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Tambah Penanaman
        </h2>
    </div>

    <div class="grid grid-cols-12 gap-5 mt-5 intro-y">
        <div class="col-span-12">
            <div class="box p-5 intro-y">
                {{-- Form --}}
                <form action="{{ route('tanaman.store') }}" method="POST">
                    @csrf
                    <div class="form-inline">
                        <label for="nama_penanaman" class="form-label sm:w-32">Nama Penanaman</label>
                        <input name="nama_penanaman" type="text" class="form-control" placeholder="Nama Penanaman">
                    </div>

                    <div class="form-inline mt-5">
                        <label for="keterangan" class="form-label sm:w-32">Keterangan</label>
                        <textarea name="keterangan" type="text" class="form-control" placeholder="Keterangan Penanaman"></textarea>
                    </div>

                    <div class="form-inline mt-5">
                        <label for="id_lahan" class="form-label sm:w-32">Nama Lahan</label>
                        <select class="form-control tom-select mt-2" data-placeholder="Pilih lahan" name="id_lahan"
                            {{ $seluruhLahan == null ? 'disabled' : '' }}>
                            @foreach ($seluruhLahan as $lahan)
                                <option value="{{ $lahan->id_lahan }}">{{ $lahan->nama_lahan }} ||
                                    {{ $lahan->kecamatan }},
                                    {{ $lahan->kota }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-inline mt-5">
                        <label for="jenis_tanaman" class="form-label sm:w-32">Jenis Tanaman</label>
                        <select class="form-control tom-select mt-2" data-placeholder="Pilih jenis tanaman"
                            name="jenis_tanaman">
                            <option selected>Bawang Merah</option>
                        </select>
                    </div>

                    <div class="form-inline mt-5">
                        <label for="tanggal_tanaman" class="form-label sm:w-32">Tanggal Tanam</label>
                        <div class="relative w-56">
                            <div
                                class="absolute top-0 left-0 rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500">
                                <i class="fa-solid fa-calendar w-4 h-4"></i>
                            </div>
                            <input name="tanggal_tanaman" type="text" class="form-control pl-12" id="dateMulaiTanam">
                        </div>
                    </div>

                    <div class="form-inline mt-5 hidden" id="selesaiTanam">
                        <label for="tanggal_selesai" class="form-label sm:w-32">Tanggal Panen</label>
                        <div class="relative w-56">
                            <div
                                class="absolute top-0 left-0 rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500">
                                <i class="fa-solid fa-calendar w-4 h-4"></i>
                            </div>
                            <input name="tanggal_selesai" type="text" class="form-control pl-12" id="dateSelesaiTanam">
                        </div>
                    </div>

                    <div class="form-inline mt-5 sm:ml-32 sm:pl-5">
                        <div class="form-check form-switch">
                            <input name="aktif" class="form-check-input" type="checkbox" id="inputPenanaman" checked>
                            <label class="form-check-label" for="aktif" id="keteranganPenanaman">
                                Penanaman <span class="text-primary font-semibold">sedang
                                    berlangsung</span>. Tekan tombol <i class="fa-solid fa-toggle-on text-primary"></i>
                                di kiri untuk menandakan penanaman sudah selesai
                            </label>
                        </div>
                    </div>

                    <div class="sm:ml-32 sm:pl-5 mt-5">
                        <button class="btn btn-primary" type="submit">Tambah Tanaman</button>
                        <a href="{{ route('tanaman.index') }}">
                            <button class="ml-2 btn w-20" type="button">Batal</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@include('pages.tanaman.scripts-tanaman')
