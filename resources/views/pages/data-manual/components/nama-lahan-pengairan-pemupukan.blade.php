<div class="form-inline">
    <label for="nama_penanaman" class="form-label sm:w-32">Nama Penanaman</label>
    <select class="form-control tom-select mt-1" data-placeholder="Pilih Penanaman" name="id_penanaman" id="id_penanaman">
        @foreach ($seluruhLahan as $lahan)
            <optgroup label="{{ $lahan->nama_lahan . ' || ' . $lahan->kecamatan . ', ' . $lahan->kota }}">
                @foreach ($lahan->penanaman as $penanaman)
                    <option value="{{ $penanaman->id_penanaman }}"
                        {{ isset($tanaman) && $tanaman->id_penanaman == $penanaman->id_penanaman ? 'selected' : '' }}
                        {{ $penanaman->alat_terpasang == 0 ? 'disabled' : '' }}>
                        {{ $penanaman->nama_penanaman }} {{ $penanaman->alat_terpasang == 0 ? '|| Tidak dapat melakukan penyiraman otomatis' : '' }}</option>
                @endforeach
            </optgroup>
        @endforeach
    </select>
</div>
