@extends('layout.side-menu')

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Daftar Lahan
        </h2>

    </div>

    <div class="grid grid-cols-12 gap-5 mt-5 intro-y">
        <div class="col-span-12 xl:col-span-3">
            <div class="box p-5 intro-y h-full">
                <div class="flex flex-col items-start">
                    {{-- Form --}}
                    <form action="{{ route('lahan.store') }}" class="ms-0 md:ms-4" method="POST">
                        @csrf

                        <label for="nama_lahan" class="form-label sm:w-32">Nama lahan</label>
                        <input name="nama_lahan" type="text" class="form-control" placeholder="Nama lahan">

                        <label for="deskripsi" class="form-label mt-4 sm:w-32">Deskripsi</label>
                        <textarea name="deskripsi" type="text" class="form-control" placeholder="Deskripsi"></textarea>

                        <label for="koordinat" class="form-label mt-4 sm:w-32">Koordinat</label>
                        <div class="grid grid-cols-12 gap-2">
                            <input name="latitude" type="text" class="form-control col-span-6" id="latitude-input" placeholder="Latitude" readonly>
                            <input name="longitude" type="text" class="form-control col-span-6" id="longitude-input" placeholder="Longitude" readonly>
                        </div>

                        <p class="mt-5 text-rgb-secondary">
                            Pindahkan tanda pada peta untuk memasukkan data koordinat secara otomatis
                        </p>

                        <div class="mt-5">
                            <button class="btn btn-primary w-20" type="submit">Tambah</button>
                            <a href="{{ route('lahan.index') }}">
                                <button class="ml-2 btn w-20" type="button">Batal</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @include('pages.lahan.maps')
    </div>
@endsection

@include('pages.lahan.scripts')
