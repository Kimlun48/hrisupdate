<div class="modal-body">
        <form id="createForm">
          <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" step="1" class="form-control" id="nama" name="nama" onkeyup="Uppercase()">
          </div>

          <div class="form-group">
            <label for="jenis_karyawan">Jenis Karyawan</label>
            <select class="form-select" aria-label="jenis_karyawan" id="jenis_karyawan" name="jenis_karyawan">
              <option value="">--Pilih--</option>
              <option value="INTERNAL">INTERNAL</option>
              <option value="EXTERNAL">EXTERNAL</option>
            </select>
          </div>
          <div class="form-group">
            <label for="no_urut">No Terakhir Sistem</label>
            <input type="number" step="1" class="form-control" id="no_urut" name="no_urut">
          </div>
          <div class="form-group">
            <label for="format_depan_nik">Angka Depan NIK</label>
            <input type="number" step="1" class="form-control" id="format_depan_nik" name="format_depan_nik">
          </div>
        </form>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-light" onclick="Close()" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="createparam()">Save</button>
      </div>

      <script>

function Uppercase() {
    var inputElement = $("#nama");
    inputElement.val(inputElement.val().toUpperCase());
}
</script>