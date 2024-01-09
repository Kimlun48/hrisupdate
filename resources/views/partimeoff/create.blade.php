<div class="modal-body">
  <form id="createForm">
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="type">Type</label>
          <select name="type" id="type" class="form-control scltd time">
            <option value="IZIN">IZIN</option>
            <option value="SAKIT">SAKIT</option>
            <option value="CUTI">CUTI</option>
            <option value="OTHER">OTHER</option>
          </select>
        </div>
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" name="name" oninput="this.value = this.value.toUpperCase()">
        </div>
        <div class="form-group">
          <label for="duration">Duration</label>
          <input type="number" class="form-control" id="duration" name="duration">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="code">Upload Dokumen</label>
          <select name="dokumen" id="dokumen" class="form-control scltd time">
            <option value="Tidak">Tidak</option>
            <option value="Wajib">Wajib</option>
          </select>
        </div>
        <div class="form-group">
          <label for="code">Jatah Cuti</label>
          <select name="kuota" id="kuota" class="form-control scltd time">
            <option value="Tidak">Tidak</option>
            <option value="Mengurangi">Mengurangi</option>
          </select>
        </div>
        <div class="form-group">
          <label for="code">Code</label>
          <input type="text" class="form-control" id="code" name="code" oninput="this.value = this.value.toUpperCase()">
        </div>
      </div>

      <div class="form-group">
        <label class="">Effective date*</label>
        <input type="text" class="form-control datepicker" name="effectivedate" id="effectivedate">
        @error('effectivedate')
        <div class="alert alert-danger mt-2">
          {{ $message }}
        </div>
        @enderror
      </div>
        
      <div class="form-group">
        <label class="">End date*</label>
        <input type="text" class="form-control datepicker" name="enddate" id="enddate">
        @error('enddate')
        <div class="alert alert-danger mt-2">
            {{ $message }}
        </div>
        @enderror
      </div>

    </div>
  </form>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" onclick="Close()" data-dismiss="modal">Close</button>
  <button type="button" class="btn btn-warning" onclick="createparam()">Save</button>
</div>
<script>
  $(function () {
      // Inisialisasi datepicker
      $(".datepicker").datepicker({
          changeMonth: true, // Enable month dropdown
          changeYear: true,
          dateFormat: "dd-mm-yy", // Format tampilan tanggal
          altFormat: "dd-mm-yy", // Format tanggal yang akan disubmit (dapat disesuaikan sesuai kebutuhan)
          altField: "#datepicker", // ID elemen input yang akan menerima tanggal yang diformat
      });
  });
</script>
