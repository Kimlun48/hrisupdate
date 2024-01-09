      <div class="modal-body">
        <form id="editForm">
          <input type="hidden" id="id" name="id">
          <div class="form-group">
            <label for="awal_absen_masuk">Awal Absen Masuk</label>
            <input type="time" step="1"  value="{{$param->awal_absen_masuk}}" class="form-control" id="awal_absen_masuk" name="awal_absen_masuk">
          </div>
          <div class="form-group">
            <label for="jam_masuk">Jam Masuk</label>
            <input type="time" step="1" value="{{$param->jam_masuk}}" class="form-control" id="jam_masuk" name="jam_masuk">
          </div>
          <div class="form-group">
            <label for="maks_telat">Maks Telat</label>
            <input type="time" step="1"  value="{{$param->maks_telat}}" class="form-control" id="maks_telat" name="maks_telat">
          </div>
          <div class="form-group">
            <label for="jam_pulang">Jam Pulang</label>
            <input type="time" step="1"  value="{{$param->jam_pulang}}" class="form-control" id="jam_pulang" name="jam_pulang">
          </div>
          <div class="form-group">
              <label for="status">Status</label>
              <select class="form-control" id="status" name="status">
                  <option value="aktif" {{ $param->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                  <option value="nonaktif" {{ $param->status == 'nonaktif' ? 'selected' : '' }}>Non-Aktif</option>
              </select>
          </div>

          <div class="form-group">
            <label for="jenis_shift">Jenis Shift</label>
            <input type="text" step="1"  value="{{$param->jenis_shift}}" class="form-control" id="jenis_shift" name="jenis_shift">
          </div>
          <input type="hidden" value="{{$param->id}}" class="form-control" id="id" name="id">
        </form>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" onclick="Close()" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning" onclick="storeedit()">Save</button>
      </div>


