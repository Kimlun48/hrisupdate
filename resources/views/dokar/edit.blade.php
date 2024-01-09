<form id="editForm" >
    @csrf
    <div id="input_fields_container" class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th class="col-sm">Name</th>
                        <th class="col-sm">Document Name</th>
                        <th class="col-sm">Document Number</th>
                        <th class="col-sm">Storage Location</th>
                        <th class="col-sm">Document Type</th>
                        <th class="col-sm">Document</th>
                        <th class="col-sm">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="input-row">
                        <input type="hidden" id="id" name="id" value="{{$dokumenKaryawan->id}}">
                        <input type="hidden" name="tanggal" value="{{$skr}}">
                        <td class="col-sm">
                            <select class="selectize" name="id_kar" data-placeholder="Choose Employee" >
                                    <option value="{{ $kar->id }}">
                                        {{ $kar->nama_lengkap }} - {{ $kar->nomor_induk_karyawan }}
                                    </option>
                            </select>
                        </td>


                        <td class="col-sm">
                            <input class="form-control form-control-sm" type="text" name="nama" placeholder="Name" value="{{ $dokumenKaryawan->nama }}">
                        </td>
                        <td class="col-sm">
                          <input class="form-control form-control-sm" type="text" name="nomor_dok" placeholder="No Dokumen" value="{{ $dokumenKaryawan->nomor_dok }}">
                        </td>
                        <td class="col-sm">
                          <input class="form-control form-control-sm" type="text" name="lokasi_penyimpanan" placeholder="Lokasi Penyimpanan" value="{{ $dokumenKaryawan->lokasi_penyimpanan }}">
                        </td>
                        <td class="col-sm">
                          <select class="selectize" name="tipe_dok" data-placeholder="Choose Document" >
                              <option value="Ijazah" {{ ($dokumenKaryawan->tipe_dok == 'Ijazah') ? 'selected' : '' }}>Ijazah</option>
                              <option value="SK" {{ ($dokumenKaryawan->tipe_dok == 'SK') ? 'selected' : '' }}>SK</option>
                              <option value="Kontrak Kerja" {{ ($dokumenKaryawan->tipe_dok == 'Kontrak Kerja') ? 'selected' : '' }}>Kontrak Kerja</option>
                              <option value="SP" {{ ($dokumenKaryawan->tipe_dok == 'SP') ? 'selected' : '' }}>SP</option>
                          </select>
                        </td>
                        <td class="col-sm">
                            <a href="{{ url('http://10.1.0.9/staging_hris/DokKar/' . $dokumenKaryawan->dok_file) }}" target="_blank">
                                DOK-{{ $dokumenKaryawan->tipe_dok }}-{{ $dokumenKaryawan->getkar->nama_lengkap }}
                            </a>
                        </td>
                        <td class="col-sm">
                            <input class="form-control form-control-sm file" type="file" name="dok_file" accept="image/png, image/gif, image/jpeg, application/pdf">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn bg-cancel" onclick="Close()" data-dismiss="modal">Close</button>
        <button type="button" class="btn bg-submit" onclick="storeedit({{$dokumenKaryawan->id}})">Save</button>
    </div>
</form>



<script>
          $('.selectize').each(function () {
            $(this).selectize({
                // create: true,
            });
        });
</script>