<div class="modal-body">
  <form id="editForm">
      <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ $param->nama }}" oninput="this.value = this.value.toUpperCase()">
            </div>
              <div class="form-group">
                  <label for="duration">Duration</label>
                  <input type="number" class="form-control" id="duration" name="duration" value="{{ $param->durasi }}">
              </div>
              <div class="form-group">
                  <label for="code">Code</label>
                  <input type="text" class="form-control" id="code" name="code" value="{{ $param->kode }}" oninput="this.value = this.value.toUpperCase()">
              </div>
              <div class="form-group">
                  <label for="code">Upload Dokumen</label>
                  <select name="dokumen" id="dokumen" class="form-control scltd time">
                      <option value="Tidak" {{ $param->dokumen == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                      <option value="Wajib" {{ $param->dokumen == 'Wajib' ? 'selected' : '' }}>Wajib</option>
                  </select>
              </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="name">Type</label>
              <select name="type" id="type" class="form-control scltd time">
                  <option value="IZIN" {{ $param->type == 'IZIN' ? 'selected' : '' }}>IZIN</option>
                  <option value="SAKIT" {{ $param->type == 'SAKIT' ? 'selected' : '' }}>SAKIT</option>
                  <option value="CUTI" {{ $param->type == 'CUTI' ? 'selected' : '' }}>CUTI</option>
                  <option value="OTHER" {{ $param->type == 'OTHER' ? 'selected' : '' }}>OTHER</option>
              </select>
          </div>
              <div class="form-group">
                  <label for="code">Jatah Cuti</label>
                  <select name="kuota" id="kuota" class="form-control scltd time">
                      <option value="Tidak" {{ $param->kuota == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                      <option value="Mengurangi" {{ $param->kuota == 'Mengurangi' ? 'selected' : '' }}>Mengurangi</option>
                  </select>
              </div>
  
              <div class="form-group">
                  <label for="enddate">Status</label>
                  <select class="form-control form-control-sm col-form-input  @error('status') is-invalid @enderror" id="status" name="status" required>
                      <option value="Aktif" {{ $param->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                      <option value="NonAktif" {{ $param->status == 'NonAktif' ? 'selected' : '' }}>NonAktif</option>
                  </select>
                  @error('status')
                  <div class="alert alert-danger mt-2">
                      {{ $message }}
                  </div>
                  @enderror
              </div>

          </div>

          <div class="form-group">
            <label class="mr-sm-2">effective date*</label>
            <input type="text" class="form-control datepicker" name="effectivedate" id="effectivedate" value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $param->efektif_date)->format('d-m-Y') }}">
            @error('effectivedate')
            <div class="alert alert-danger mt-2">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label class="mr-sm-2">End date*</label>
            <input type="text" class="form-control datepicker" name="enddate" id="enddate" value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $param->expire_date)->format('d-m-Y') }}">
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
  <button type="button" class="btn btn-warning" onclick="storeedit({{$param->id}})">Save</button>
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
