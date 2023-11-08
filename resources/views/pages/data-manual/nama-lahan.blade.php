<label for="nama_penanaman" class="form-label ">Nama Penanaman</label>
<select class="form-control tom-select mt-1" data-placeholder="Pilih Penanaman" name="id_penanaman">
    @foreach ($seluruhLahan as $lahan)
        <optgroup label="{{ $lahan->nama_lahan . ' || ' . $lahan->kecamatan . ', ' . $lahan->kota }}">
            @foreach ($lahan->penanaman as $penanaman)
                <option value="{{ $penanaman->id_penanaman }}">{{ $penanaman->nama_penanaman }}</option>
            @endforeach
        </optgroup>
    @endforeach
</select>
