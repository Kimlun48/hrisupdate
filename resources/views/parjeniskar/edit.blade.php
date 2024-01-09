<div class="modal-body">
        <form id="editForm">
        <input type="hidden" id="id" name="id" value="{{$param->id}}">
          <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" step="1" class="form-control" id="nama" name="nama" onkeyup="Uppercase()" value="{{$param->nama}}">
          </div>

          <div class="form-group">
            <label for="jenis_karyawan">Jenis Karyawan {{$param}}</label>
            <select class="form-select" aria-label="jenis_karyawan" id="jenis_karyawan" name="jenis_karyawan">

                <option value="INTERNAL" {{ $param->jenis_kar == 'INTERNAL' ? 'selected' : '' }}>INTERNAL</option>
                <option value="EXTERNAL" {{ $param->jenis_kar == 'EXTERNAL' ? 'selected' : '' }}>EXTERNAL</option>
            </select>
          </div>
          <div class="form-group">
            <label for="no_urut">No Terakhir Sistem</label>
            <input type="number" step="1" class="form-control" id="no_urut" name="no_urut" value="{{$param->no_urut}}">
          </div>
          <div class="form-group">
            <label for="format_depan_nik">Angka Depan NIK</label>
            <input type="number" step="1" class="form-control" id="format_depan_nik" name="format_depan_nik" value="{{$param->format_depan_nik}}">
          </div>

          <div class="form-group">
            <label for="status">Status</label>
            <select class="form-select" aria-label="status" id="status" name="status">
                <option value="AKTIF" {{ $param == 'AKTIF' ? 'selected' : '' }}>AKTIF</option>
                <option value="NON AKTIF" {{ $param == 'NON AKTIF' ? 'selected' : '' }}>NON AKTIF</option>
            </select>
          </div>
        </form>


      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-light" onclick="Close()" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="storeedit()">Save</button>
      </div>

