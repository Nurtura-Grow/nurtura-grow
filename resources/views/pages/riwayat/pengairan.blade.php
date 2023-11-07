<table id="table" class="hover intro-y" style="width:100%">
    <thead>
        <tr>
            <th class="border-b-2 whitespace-nowrap">No</th>
            <th class="border-b-2 whitespace-nowrap">Nama Penanaman</th>
            <th class="border-b-2 whitespace-nowrap">Nama Lahan</th>
            <th class="border-b-2 whitespace-nowrap">HST</th>
            <th class="border-b-2 whitespace-nowrap">Volume Pengairan</th>
            <th class="border-b-2 whitespace-nowrap">Waktu Mulai</th>
            <th class="border-b-2 whitespace-nowrap">Waktu Selesai</th>
            <th class="border-b-2 whitespace-nowrap">Sesuai SOP?</th>
            <th class="border-b-2 whitespace-nowrap">Data Sensor</th>
        </tr>
    </thead>
    <tbody>
        @for ($i = 1; $i < 10; $i++)
            <tr>
                <td class="border-b">{{ $i }}</td>
                <td class="border-b">Nama Penanaman 1</td>
                <td class="border-b">Nama Lahan {{ $i }}</td>
                <td class="border-b">HST {{ $i }}</td>
                <td class="border-b">Volume Pengairan {{ $i }}</td>
                <td class="border-b">Waktu Mulai {{ $i }}</td>
                <td class="border-b">Waktu Selesai {{ $i }}</td>
                <td class="border-b">Sesuai SOP {{ $i }}</td>
                <td class="border-b">Data Sensor {{ $i }}</td>
            </tr>
        @endfor
    </tbody>
</table>
