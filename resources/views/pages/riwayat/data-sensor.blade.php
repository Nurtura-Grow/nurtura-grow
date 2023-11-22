<div class="mb-2" style="width: 100%">
    <div class="flex flex-col sm:flex-row sm:border-b-4 items-center h-10 sticky top-16 md:top-0 bg-white z-[9999]">
        <h1 class="font-bold text-lg">
            Grafik Data Sensor
        </h1>
        <button class="sm:ml-auto btn btn-primary h-8 text-white" data-tw-toggle="modal"
            data-tw-target="#datepicker-modal-preview">
            Pilih tanggal
        </button>
    </div>

    <div class="grid grid-cols-12 gap-x-6 gap-y-2">
        {{-- Tanggal yang dipilih --}}
        <div class="col-span-12 flex flex-col sm:flex-row justify-center items-center ml-3 pt-5">
            <span class="font-bold">Data pada tanggal:</span>
            <span class="ml-1" id="tanggalTerpilih"></span>
        </div>

        {{-- Data Grafik --}}
        <div class="col-span-12 xl:col-span-6 p-5">
            <h1 class="font-bold text-md">
                Data Sensor Suhu Udara
            </h1>
            <canvas id="suhu"></canvas>
        </div>
        <div class="col-span-12 xl:col-span-6 p-5">
            <h1 class="font-bold text-md">
                Data Sensor Kelembapan Udara
            </h1>
            <canvas id="kelembapan_udara"></canvas>
        </div>
        <div class="col-span-12 xl:col-span-6 p-5">
            <h1 class="font-bold text-md">
                Data Sensor Kelembapan Tanah
            </h1>
            <canvas id="kelembapan_tanah"></canvas>
        </div>
        <div class="col-span-12 xl:col-span-6 p-5">
            <h1 class="font-bold text-md">
                Data Sensor pH Tanah
            </h1>
            <canvas id="ph_tanah"></canvas>
        </div>
    </div>
</div>

{{-- Tabel --}}
<div class="">
    <h1 class="mb-3 text-lg font-bold border-b-4 sticky top-16 md:top-0 bg-white z-[9999]">Tabel Riwayat Data Sensor</h1>
    <table id="table" class="hover intro-y overflow-x-hidden" style="width:100%">
        <thead>
            <tr>
                <th class="border-b-2 whitespace-nowrap">No</th>
                <th class="border-b-2 whitespace-nowrap">Nama Penanaman</th>
                <th class="border-b-2 whitespace-nowrap">Nama Lahan</th>
                <th class="border-b-2 whitespace-nowrap">Suhu Udara</th>
                <th class="border-b-2 whitespace-nowrap">Kelembapan Udara</th>
                <th class="border-b-2 whitespace-nowrap">Kelembapan Tanah</th>
                <th class="border-b-2 whitespace-nowrap">pH Tanah</th>
                <th class="border-b-2 whitespace-nowrap">Diukur pada</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_sensor as $data)
                <tr>
                    <td class="border-b">{{ $loop->index + 1 }}</td>
                    <td class="border-b">{{ $data->nama_penanaman }}</td>
                    <td class="border-b">{{ $data->nama_lahan }}</td>
                    <td class="border-b">{{ $data->suhu }}</td>
                    <td class="border-b">{{ $data->kelembapan_udara }}</td>
                    <td class="border-b">{{ $data->kelembapan_tanah }}</td>
                    <td class="border-b">{{ $data->ph_tanah }}</td>
                    <td class="border-b" data-sort="{{ $data->attribute_timestamp }}">{{ $data->timestamp_pengukuran }}
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

</div>

@include('pages.components.modal-datepicker')

@push('scripts')
    <script>
        var urlDashboard = "{{ route('dashboard.data') }}";
    </script>

    @vite(['resources/js/pages/riwayat/data-sensor.js', 'resources/js/pages/riwayat/litepickr.js'])
@endpush
