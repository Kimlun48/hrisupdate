<div class="modal-body">
    <form id="editForm">
        <input type="hidden" id="id" name="id">

        <div class="mb-3 row row-body">
              <label class="col-lg-3 col-form-label">Status</label>
              <div class="col-lg-1">:</div>
              <div class="col-lg-8 col-content">
              <div class="text">{{ $pas->status}}</div>
              </div>
          </div>
        
        <div class="mb-3 row row-body">
            <label class="col-lg-3 col-form-label">Chapter</label>
                <div class="col-lg-1">:</div>
                <div class="col-lg-8 col-content">
                <div class="text">{{ $pas->pasal}}</div>
                </div>
            </div>
      
      <div class="mb-3 row row-body">
            <label class="col-lg-3 col-form-label">Paragraph</label>
                <div class="col-lg-1">:</div>
                <div class="col-lg-8 col-content">
                <div class="text">{{ $pas->ayat}}</div>
                </div>
        </div>
   
      <div class="mb-3 row row-body">
        <label class="col-lg-3 col-form-label">Fill</label>
            <div class="col-lg-1">:</div>
                <div class="col-lg-8 col-content">
                    <div class="text">{{ $pas->isiayat}}</div>
                </div>
            </div>

      <input type="hidden" value="{{$pas->id}}" class="form-control" id="id" name="id">
    </form>
  </div>
  <div class="modal-footer">
  <button type="button" class="btn btn-secondary" onclick="Close()" data-dismiss="modal">Close</button>
  </div>

