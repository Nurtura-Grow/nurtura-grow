@extends('layout.side-menu')

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Tambah Tanaman
        </h2>
    </div>

    <div class="grid grid-cols-12 gap-5 mt-5 intro-y">
        <div class="col-span-12">
            <div class="box p-5 intro-y">
                <a href="{{ route('tanaman.index') }}">
                    <div class="text-primary ms-0 md:ms-4 my-4">
                        <i class="fa-solid fa-arrow-left mr-2"></i>Kembali
                    </div>
                </a>

                {{-- Form --}}
                <form action="{{ route('tanaman.store') }}" method="POST">
                    @csrf
                    <div class="form-inline">
                        <label for="horizontal-form-1" class="form-label sm:w-32">Nama Penanaman</label>
                        <input name="nama_penanaman" type="text" class="form-control" placeholder="Nama Penanaman">
                    </div>

                    <div class="form-inline mt-5">
                        <label for="horizontal-form-2" class="form-label sm:w-32">Keterangan</label>
                        <input name="keterangan" type="text" class="form-control" placeholder="Keterangan Penanaman">
                    </div>

                    <div class="form-inline mt-5">
                        <label for="horizontal-form-2" class="form-label sm:w-32">Nama Lahan</label>
                        <select class="form-control mt-2" name="nama_lahan">
                            {{-- Todo: Change the option to match the database --}}
                            <option>Chris Evans</option>
                            <option>Liam Neeson</option>
                            <option>Daniel Craig</option>
                        </select>
                    </div>

                    <div class="form-inline mt-5">
                        <label for="horizontal-form-2" class="form-label sm:w-32">Jenis Tanaman</label>
                        <select class="form-control mt-2" name="jenis_tanaman">
                            {{-- Todo: Change the option to match the database --}}
                            <option>Chris Evans</option>
                            <option>Liam Neeson</option>
                            <option>Daniel Craig</option>
                        </select>
                    </div>

                    <div class="form-inline mt-5">
                        <label for="horizontal-form-2" class="form-label sm:w-32">Tanggal Tanam</label>
                        <div class="relative w-56">
                            <div
                                class="absolute top-0 left-0 rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500">
                                <i class="fa-solid fa-calendar w-4 h-4"></i>
                            </div>
                            <input name="tanggal_tanaman" type="text" class="datepicker form-control pl-12" data-single-mode="true">
                        </div>
                    </div>

                    <div class="sm:ml-32 sm:pl-5 mt-5">
                        <button class="btn btn-primary" type="submit">Tambah</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    </div>
@endsection
