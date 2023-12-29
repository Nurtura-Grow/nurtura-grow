@extends('layout.side-menu')

@section('subcontent')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8 hidden" id="judul-section-sop">
        <h2 class="text-lg font-medium mr-auto">
            Kondisi Ideal untuk Pengairan
        </h2>

        <div class="w-full sm:w-auto flex mt-4 sm:mt-0" id="sembunyikan-section-rekomendasi">
            <button class="btn bg-rgb-secondary text-white shadow-md">
                <i class="fa-regular fa-eye-slash mr-2"></i>Sembunyikan Rekomendasi dan SOP Pengairan
            </button>
        </div>
    </div>

    {{-- Rekomendasi Pengairan --}}
    <div class="flex flex-col min-h-[68vh] mt-5 gap-4 hidden" id="section-rekomendasi">
        <div class="intro-y grow basis-1/2 box p-5">
            <p class="mb-5">Kondisi ini akan digunakan sebagai pengaturan optimal untuk irigasi, nilai di sebelah kiri
                menunjukkan nilai minimal dan di sebelah kanan menunjukkan nilai maksimal.</p>

            <form action="{{ route('manual.pengairan.sop') }}" method="POST">
                @method('PUT')
                @csrf

                {{-- Suhu Udara --}}
                <div class="form-inline">
                    <label for="suhu-udara" class="form-label sm:w-32">Suhu Udara</label>
                    <div class="grid grid-cols-12">
                        <input type="text" class="form-control col-span-4 form-pengairan" placeholder="Nilai Minimal"
                            aria-label="suhu-udara" name='temperature[]' value="{{ $sopPengairan['temperature_min'] }}" readonly>
                        <p class="col-span-1 flex items-center justify-center font-bold"> - </p>
                        <input type="text" class="form-control col-span-4 form-pengairan" placeholder="Nilai Maksimal"
                            aria-label="suhu-udara" name='temperature[]' value="{{ $sopPengairan['temperature_max'] }}" readonly>
                        <p class="flex items-center justify-center font-bold">C</p>
                    </div>
                </div>

                {{-- Kelembapan Udara --}}
                <div class="form-inline mt-5">
                    <label for="kelembapan-udara" class="form-label sm:w-32">Kelembapan Udara</label>
                    <div class="grid grid-cols-12">
                        <input type="text" class="form-control col-span-4 form-pengairan" placeholder="Nilai Minimal"
                            aria-label="kelembapan-udara" name="humidity[]" value="{{ $sopPengairan['humidity_min'] }}" readonly>
                        <p class="col-span-1 flex items-center justify-center font-bold"> - </p>
                        <input type="text" class="form-control col-span-4 form-pengairan" placeholder="Nilai Maksimal"
                            aria-label="kelembapan-udara" name="humidity[]" value="{{ $sopPengairan['humidity_max'] }}" readonly>
                        <p class="flex items-center justify-center font-bold">%</p>
                    </div>
                </div>

                {{-- Kelembapan Tanah --}}
                <div class="form-inline mt-5">
                    <label for="kelembapan-tanah" class="form-label sm:w-32">Kelembapan Tanah</label>
                    <div class="grid grid-cols-12">
                        <input type="text" class="form-control col-span-4 form-pengairan" placeholder="Nilai Minimal"
                            aria-label="kelembapan-tanah" name="soil_moisture[]" value="{{ $sopPengairan['soil moisture_min'] }}" readonly>
                        <p class="col-span-1 flex items-center justify-center font-bold"> - </p>
                        <input type="text" class="form-control col-span-4 form-pengairan" placeholder="Nilai Maksimal"
                            aria-label="kelembapan-tanah" name="soil_moisture[]" value="{{ $sopPengairan['soil moisture_max'] }}" readonly>
                        <p class="flex items-center justify-center font-bold">%</p>
                    </div>
                </div>

                <div class="intro-y sm:ml-32 sm:pl-5 mt-5">
                    <button type="button" class="btn btn-primary w-48" id="ubah-data">Ubah Data</button>
                </div>


                <p class="text-danger hidden mt-5 mb-5" id="keterangan-sop">Keterangan: </p>
                <div class="intro-y flex md:flex-row hidden" id="button-submit-form">
                    <div class="sm:ml-32 sm:pl-5">
                        <button type="submit" class="btn btn-primary w-48" id="ubah-submit">Ubah Data Pengairan</button>
                    </div>
                    <div class="ml-4">
                        <button type="button" class="btn w-48" id="batal-submit">Batal</button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Bawah --}}
        <div class="grow basis-1/2 flex flex-col lg:flex-row gap-5 mb-8">
            <div class="basis-1/2">
                <h3 class="intro-y font-medium text-lg mb-3">Grafik Perbandingan</h3>
                <div class="intro-y h-full box p-5 flex flex-col items-center justify-center">

                    <div class="flex flex-col sm:flex-row gap-5">
                        <div class="w-40 sm:w-56 lg:w-64">
                            <select data-placeholder="Pilih grafik yang ditunjukkan" id="pilihGrafik"
                                class="tom-select w-full">
                                @foreach ($grafik as $graf)
                                    <option>{{ $graf['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Grafik Pengairan --}}
                        <a class="relative btn btn-primary text-white" data-tw-toggle="modal"
                            data-tw-target="#datepicker-modal-preview">
                            Pilih tanggal
                        </a>
                    </div>

                    <div class="mt-2">
                        <p class="text-center font-semibold">Tanggal: <span id="tanggalTerpilih" class="font-normal">31
                                Desember 2023</span></p>
                    </div>

                    <div class="grow w-full h-full flex justify-center items-center" id="container-grafik">
                        <canvas class="w-fit h-fit" id="grafik-pengairan"></canvas>
                    </div>

                    <p>Keterangan: data minimal dan maksimal yang ditampilkan adalah kondisi ideal untuk penyiraman</p>
                </div>
            </div>

            {{-- Aksi Pengairan --}}
            <div class="basis-1/2">
                <h3 class="intro-y font-medium text-lg mb-3">Aksi Pengairan</h3>

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

                    {{-- Penyiraman Terakhir --}}
                    <div class="intro-y">
                        <p class="font-bold">Penyiraman Terakhir</p>
                        <span
                            class="">{{ $pengairan['terakhir']['tanggal'] ?? 'Tidak ada penyiraman terakhir' }}</span>

                        @if (isset($pengairan['terakhir']['tanggal']))
                            <div class="flex mt-2">
                                <span class="basis-1/6">Pukul:</span>
                                <span>{{ $pengairan['terakhir']['waktu_mulai'] }} -
                                    {{ $pengairan['terakhir']['waktu_selesai'] }}</span>
                            </div>
                            <div class="flex">
                                <span class="basis-1/6">Volume:</span>
                                <span>{{ $pengairan['terakhir']['volume'] }} L</span>
                            </div>
                        @endif
                    </div>

                    @if ($pengairan['rekomendasi'] == null && $pengairan['selanjutnya'] == null)
                        {{-- Rekomendasi Penyiraman Selanjutnya (Otomatis) --}}
                        <div class="intro-y">
                            <p class="font-bold">Tidak ada rekomendasi/aksi penyiraman selanjutnya</p>
                        </div>

                        <div class="intro-y">
                            <p>Siram Sekarang?</p>
                            <a href="#input-manual" class="w-full btn btn-primary px-5">
                                Ya, siram sekarang
                            </a>
                        </div>
                    @elseif($pengairan['rekomendasi'] == null && $pengairan['selanjutnya'] != null)
                        {{-- Aksi Penyiraman Selanjutnya (Manual) --}}
                        <div class="intro-y">
                            <p class="font-bold">Aksi Penyiraman Selanjutnya</p>
                            <span class="">{{ $pengairan['selanjutnya']['tanggal'] }}</span>

                            <div class="flex mt-2">
                                <span class="basis-1/6">Pukul:</span>
                                <span>{{ $pengairan['selanjutnya']['waktu_mulai'] }} -
                                    {{ $pengairan['selanjutnya']['waktu_selesai'] }}</span>
                            </div>
                            <div class="flex">
                                <span class="basis-1/6">Volume:</span>
                                <span>{{ $pengairan['selanjutnya']['volume'] }} L</span>
                            </div>
                        </div>

                        {{-- Aksi Penyiraman (anda mau mengubah/menghapus?) --}}
                        <div class="intro-y">
                            <p class="mb-2 font-bold">Apakah Anda ingin mengubah/menghapus data penyiraman selanjutnya?</p>
                            <div class="flex flex-col xl:flex-row gap-2">
                                <a href="{{ route('manual.pengairan.edit', ['pengairan' => $pengairan['selanjutnya']['id_irrigation_controller']]) }}"
                                    class="basis-1/2 w-full btn  px-5">
                                    <i class="w-4 h-4 mr-1 fa-solid fa-pencil"></i>Ubah
                                </a>
                                <span class="basis-1/2 w-full px-5 hover:cursor-pointer whitespace-nowrap btn btn-danger"
                                    onclick="deleteAksi(this)" data-tw-toggle="modal" data-tw-target="#deleteAksi"
                                    data-aksi='{{ json_encode(['id' => $pengairan['selanjutnya']['id_irrigation_controller']]) }}'>
                                    <i class="w-4 h-4 mr-1 fa-solid fa-trash"></i>Hapus
                                </span>
                            </div>
                        </div>
                    @elseif($pengairan['rekomendasi'] != null)
                        {{-- Aksi Penyiraman Selanjutnya (Auto) --}}
                        <div class="intro-y">
                            <p class="font-bold">Aksi Penyiraman Selanjutnya
                                <span class="font-semibold">(REKOMENDASI SISTEM)</span>
                            </p>
                            <span class="">{{ $pengairan['rekomendasi']['tanggal'] }}</span>

                            <div class="flex mt-2">
                                <span class="basis-1/6">Pukul:</span>
                                <span>{{ $pengairan['rekomendasi']['waktu_mulai'] }} -
                                    {{ $pengairan['rekomendasi']['waktu_selesai'] }}</span>
                            </div>
                            <div class="flex">
                                <span class="basis-1/6">Volume:</span>
                                <span>{{ $pengairan['rekomendasi']['volume'] }} L</span>
                            </div>
                        </div>

                        {{-- Aksi Penyiraman (anda mau menyiram sekarang?) --}}
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

                    <div class="intro-y hidden" id="rekomendasi-sistem">
                        <p class="font-semibold">Penyiraman akan dilaksanakan <span class="text-slate-400">sesuai
                                rekomendasi sistem</span>
                            <i class="fa-solid fa-face-smile-wink text-warning"></i>
                        </p>
                        <button class="btn border-2 shadow-md p-3 w-full mt-2" id="batalkan">Batalkan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Form Input Manual Pengairan --}}
    <div class="intro-y flex flex-col sm:flex-row items-center mt-5" id="input-manual">
        <h2 class="text-lg font-medium mr-auto">
            Input Manual Pengairan
        </h2>

        <div class="w-full sm:w-auto flex mt-4 sm:mt-0" id="button-tampilkan-sop">
            <button class="btn bg-rgb-secondary text-white shadow-md">
                <i class="fa-solid fa-eye mr-2"></i>Tampilkan SOP dan Rekomendasi Pengairan
            </button>
        </div>
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
                    <input name="tanggal_pengairan" type="text" class="form-control pl-12"
                        value="{{ $tanggalSekarang }}" readonly>
                </div>
            </div>

            {{-- Volume/Durasi --}}
            <div class="form-inline mt-5">
                <label for="tanggal_pengairan" class="form-label sm:w-32">Volume air/durasi penyiraman alat</label>
                <div class="w-full">
                    {{-- Volume Pengairan --}}
                    <div class="clickable-box flex flex-row mt-2 ml-4 py-3 px-4 border-2 rounded-lg shadow-md">
                        <input class="form-check-input input-pengairan" type="radio" name="pengairan" checked>
                        <div>
                            <label class="form-check-label ml-4" for="volume_pengairan">Volume Pengairan</label>

                            <div class="grid grid-cols-12 gap-2 w-auto sm:w-56 ml-4 mt-2">
                                <input name="volume_pengairan" type="text" class="form-control col-span-6"
                                    placeholder="10" id="volume">
                                <select class="form-select col-span-6" name="satuan" id="satuan">
                                    <option selected>L</option>
                                    <option>mL</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Waktu Pengairan --}}
                    <div class="clickable-box flex flex-row mt-5 ml-4 py-3 px-4 border-2 rounded-lg shadow-md">
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
                                    <input type="text" class="form-control waktu-mulai pl-12" id="waktu_mulai"
                                        placeholder="Waktu Mulai" aria-label="waktu" name="waktu_mulai">
                                </div>
                                {{-- Waktu Selesai --}}
                                <div class="relative w-auto sm:w-56">
                                    <div
                                        class="absolute top-0 left-0 rounded-l w-10 h-full flex items-center justify-center bg-slate-100 border text-slate-500">
                                        <i class="fa-regular fa-clock w-4 h-4"></i>
                                    </div>
                                    <input type="text" class="form-control waktu-selesai pl-12" id="waktu_selesai"
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
                        Volume akan menyesuaikan debit pengairan (kelipatan 7 sebelumnya)
                    </li>
                    <li>
                        Waktu pengairan <span class="font-bold">maksimal 180 menit</span>
                    </li>
                    <li>
                        Debit sprinkler: <span class="font-bold">7 L/menit</span>
                    </li>

                    <li>
                        Terdapat kemungkinan untuk menambahkan waktu sebanyak 1 - 2 menit.
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
@include('pages.components.modal-datepicker')


@push('scripts')
    <script defer>
        let urlDashboard = '{{ route('dashboard.data') }}'
        const routePengairanDestroy = "{{ route('manual.pengairan.destroy', ['pengairan' => ':id_pengairan']) }}"

        function deleteAksi(element) {
            // Get data-aksi attribute
            const dataAksi = JSON.parse(element.getAttribute('data-aksi'));
            const id = dataAksi.id;


            let route = routePengairanDestroy.replace(':id_pengairan', id);
            console.log(id, route)

            // Change Form
            const form = document.getElementById('formDeleteAksi');
            form.setAttribute('action', route);
        }
    </script>
    @vite(['resources/js/pages/dashboard/litepickr.js', 'resources/js/pages/data-manual/pengairan-pemupukan.js', 'resources/js/pages/data-manual/pengairan.js'])
@endpush
