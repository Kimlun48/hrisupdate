<div class="modal-body">
    <form id="editForm">
        <input type="hidden" id="id" name="id">

        <div class="mb-3 row row-body">
              <label class="col-lg-3 col-form-label">Awal Absen Masuk</label>
              <div class="col-lg-1">:</div>
              <div class="col-lg-8 col-content">
              <div class="text">{{ $param->awal_absen_masuk}}</div>
              </div>
          </div>
        
        <div class="mb-3 row row-body">
            <label class="col-lg-3 col-form-label">Jam Masuk</label>
                <div class="col-lg-1">:</div>
                <div class="col-lg-8 col-content">
                <div class="text">{{ $param->jam_masuk}}</div>
                </div>
            </div>
      
      <div class="mb-3 row row-body">
            <label class="col-lg-3 col-form-label">Maksimal Telat</label>
                <div class="col-lg-1">:</div>
                <div class="col-lg-8 col-content">
                <div class="time">{{ $param->maks_telat}}</div>
                </div>
        </div>
   
      <div class="mb-3 row row-body">
        <label class="col-lg-3 col-form-label">Jam Pulang</label>
            <div class="col-lg-1">:</div>
                <div class="col-lg-8 col-content">
                    <div class="text">{{ $param->jam_pulang}}</div>
                </div>
            </div>

      <input type="hidden" value="{{$pas->id}}" class="form-control" id="id" name="id">
    </form>
  </div>
  <div class="modal-footer">
  <button type="button" class="btn btn-secondary" onclick="Close()" data-dismiss="modal">Close</button>
  </div>

