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
                        <span
                            class="">{{ $pemupukan['terakhir']['tanggal'] ?? 'Tidak ada pemupukan terakhir' }}</span>


                        @if (isset($pemupukan['terakhir']['tanggal']))
                            <div class="flex mt-2">
                                <span class="basis-1/6">Pukul:</span>
                                <span>{{ $pemupukan['terakhir']['waktu_mulai'] }} -
                                    {{ $pemupukan['terakhir']['waktu_selesai'] }}</span>
                            </div>
                            <div class="flex">
                                <span class="basis-1/6">Volume:</span>
                                <span>{{ $pemupukan['terakhir']['volume'] }} L</span>
                            </div>
                        @endif
                    </div>

                    {{-- Rekomendasi Pemupukan Selanjutnya --}}
                    @if ($pemupukan['rekomendasi'] == null && $pemupukan['selanjutnya'] == null)
                        <div class="intro-y">
                            <p class="font-bold">Tidak ada rekomendasi/aksi Pemupukan selanjutnya</p>
                        </div>

                        <div class="intro-y">
                            <p>Beri Pupuk Sekarang?</p>
                            <a href="#input-manual" class="w-full btn btn-primary px-5">
                                Ya, beri pupuk sekarang
                            </a>
                        </div>
                    @elseif($pemupukan['rekomendasi'] == null && $pemupukan['selanjutnya'] != null)
                        {{-- Aksi Pemupukan Selanjutnya (Manual) --}}
                        <div class="intro-y">
                            <p class="font-bold">Aksi Pemupukan Selanjutnya</p>
                            <span class="">{{ $pemupukan['selanjutnya']['tanggal'] }}</span>

                            <div class="flex mt-2">
                                <span class="basis-1/6">Pukul:</span>
                                <span>{{ $pemupukan['selanjutnya']['waktu_mulai'] }} -
                                    {{ $pemupukan['selanjutnya']['waktu_selesai'] }}</span>
                            </div>
                            <div class="flex">
                                <span class="basis-1/6">Volume:</span>
                                <span>{{ $pemupukan['selanjutnya']['volume'] }} L</span>
                            </div>
                        </div>

                        {{-- Aksi Pemupukan (anda mau menyiram sekarang?) --}}
                        <div class="intro-y">
                            <p class="mb-2 font-bold">Apakah Anda ingin mengubah/menghapus data Pemupukan selanjutnya?</p>
                            <div class="flex flex-col xl:flex-row gap-2">
                                <a href="{{ route('manual.pemupukan.edit', ['pemupukan' => $pemupukan['selanjutnya']['id_fertilizer_controller']]) }}"
                                    class="basis-1/2 w-full btn  px-5">
                                    Ubah
                                </a>
                                <span class="basis-1/2 w-full px-5 hover:cursor-pointer whitespace-nowrap btn btn-danger"
                                    onclick="deleteAksi(this)" data-tw-toggle="modal" data-tw-target="#deleteAksi"
                                    data-aksi='{{ json_encode(['id' => $pemupukan['selanjutnya']['id_fertilizer_controller']]) }}'>
                                    <i class="w-4 h-4 mr-1 fa-solid fa-trash"></i>Hapus
                                </span>
                            </div>
                        </div>
                    @elseif($pemupukan['rekomendasi'] != null)
                        {{-- Aksi Pemupukan Selanjutnya (Auto) --}}
                        <div class="intro-y">
                            <p class="font-bold">Aksi Pemupukan Selanjutnya
                                <span class="font-semibold">(REKOMENDASI SISTEM)</span>
                            </p>
                            <span class="">{{ $pemupukan['rekomendasi']['tanggal'] }}</span>

                            <div class="flex mt-2">
                                <span class="basis-1/6">Pukul:</span>
                                <span>{{ $pemupukan['rekomendasi']['waktu_mulai'] }} -
                                    {{ $pemupukan['rekomendasi']['waktu_selesai'] }}</span>
                            </div>
                            <div class="flex">
                                <span class="basis-1/6">Volume:</span>
                                <span>{{ $pemupukan['rekomendasi']['volume'] }} L</span>
                            </div>
                        </div>

                        {{-- Aksi Pemupukan (anda mau menyiram sekarang?) --}}
                        <div class="intro-y" id="jalankan-aksi-sekarang">
                            <p class="mb-2 font-bold">Apakah Anda ingin menyiram sekarang?</p>
                            <div class="flex flex-col xl:flex-row gap-2">
                                <a href="#input-manual" class="basis-1/2 w-full btn btn-primary px-5">
                                    Ya, abaikan rekomendasi sistem
                                </a>
                                <a href="#judul-section-sop" class="basis-1/2 w-full btn px-5"
                                    id="jalankan-rekomendasi">Tidak, ikuti rekomendasi sistem
                                </a>
                            </div>
                        </div>
                    @endif

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
                    <input name="tanggal_pemupukan" type="text" class="form-control pl-12"
                        value="{{ $tanggalSekarang }}" readonly>
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
                                    placeholder="10" id="volume">
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
                                    <input type="text" class="form-control waktu-mulai pl-12"
                                        placeholder="Waktu Mulai" aria-label="waktu" name="waktu_mulai">
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

            {{-- Durasi --}}
            <div class="form-inline mt-5">
                <label for="durasi" class="form-label sm:w-32">Durasi</label>
                <input type="text" class="form-control" name="durasi"
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

                    <li class="font-bold text-warning">
                        <i class="fa-solid fa-triangle-exclamation mr-2"></i>
                        Aksi Anda akan menggantikan rekomendasi sistem.
                        <i class="fa-solid fa-triangle-exclamation ml-2"></i>
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

    {{-- Modal Delete --}}
    <div id="deleteAksi" class="modal" tabindex="-1" aria-hidden="true" data-tw-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="p-5 text-center"> <i data-lucide="x-circle"
                            class="w-16 h-16 text-danger mx-auto mt-3"></i>
                        <div class="text-3xl mt-5">Apakah Anda yakin?</div>
                        <div class="text-slate-500 mt-2">
                            Apakah Anda sungguh ingin menghapus data ini? <br>Data ini tidak dapat dikembalikan.
                        </div>
                    </div>
                    <div class="px-5 pb-8 flex justify-center">
                        <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">
                            Batalkan
                        </button>

                        <form method="POST" id="formDeleteAksi">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger w-24">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('pages.data-manual.components.scripts')

@push('scripts')
    <script defer>
        const routePemupukanDestroy = "{{ route('manual.pemupukan.destroy', ['pemupukan' => ':id_pemupukan']) }}"

        function deleteAksi(element) {
            // Get data-tanaman attribute
            const dataAksi = JSON.parse(element.getAttribute('data-aksi'));
            const id = dataAksi.id;

            let route = routePemupukanDestroy.replace(':id_pemupukan', id);

            // Change Form
            const form = document.getElementById('formDeleteAksi');
            form.setAttribute('action', route);
        }
    </script>
    @vite(['resources/js/pages/data-manual/pengairan-pemupukan.js', 'resources/js/pages/data-manual/pemupukan.js'])
@endpush
