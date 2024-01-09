<div class="modal-body">
    <form id="editForm">
    <input type="hidden" id="id" name="id" value="{{$jabs->id}}">

        <div class="mb-3 row row-body">
              <label class="col-lg-3 col-form-label">nama</label>
              <div class="col-lg-1">:</div>
              <div class="col-lg-8 col-content">
              <div class="text">{{ $jabs->nama}}</div>
              </div>
          </div>
        
        <div class="mb-3 row row-body">
            <label class="col-lg-3 col-form-label">kode</label>
                <div class="col-lg-1">:</div>
                <div class="col-lg-8 col-content">
                <div class="text">{{ $jabs->kode}}</div>
                </div>
            </div>
      
      <div class="mb-3 row row-body">
            <label class="col-lg-3 col-form-label">status</label>
                <div class="col-lg-1">:</div>
                <div class="col-lg-8 col-content">
                <div class="text">{{ $jabs->status}}</div>
                </div>
        </div>
   
        <div class="mb-3 row row-body">
        <label class="col-lg-3 col-form-label">parent jabatan</label>
            <div class="col-lg-1">:</div>
                <div class="col-lg-8 col-content">
                @if($jabs->parent_id)
                    <div class="text">{{ $jabs->parent->nama }}</div>
                    @else
                    <div></div>
                    @endif
                </div>
            </div>

    </form>
  </div>
  <div class="modal-footer">
  <button type="button" class="btn btn-secondary" onclick="Close()" data-dismiss="modal">Close</button>
  </div>

