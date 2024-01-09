<!-- Start Modals Approve -->
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approve Process {{$det->progres}}</h5>
          <button type="button" class="close" onclick="Close()" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
      <form id="myform" enctype="multipart/form-data">
        <div class="container container-create-verif">
           <div class="row row-create">
             <div class="col col-create">
               <div class="card card-create">
		            <div class="card-body" name="bookId" id="bookId">		                
                    <div class="mb-3 row row-body">
                    <label class="col-sm-3 col-form-label">Date of
                      @if($det->progres == "Administration") Interview 
                      @elseif($det->progres == "Interview") Psychotest
                      @elseif($det->progres == "Psychotest") Interview User 
                      @elseif($det->progres == "Interview User") Offering Letter 
                      @else($det->progres == "Offering Letter") Contract 
                      @endif <span class="text-danger">*</span></label>
                    <div class="col-sm-5">
                      <input class="form-control col-form-input" type="date" id="waktu" name="waktu">    
                    @error('waktu')
                      <div class="alert alert-danger mt-2">
                        {{ $message }}
                      </div>
                    @enderror
                    </div>
                  </div>
			          <div class="mb-3 row row-body">
                  <input type = "hidden" id="cekid" name="cekid" value="{{{$det->id}}}">
                  <label class="col-sm-3 col-form-label">Note <span class="text-danger">*</span></label>
                <div class="col-sm-9">
                  <textarea class="form-control col-form-input  @error('note') is-invalid @enderror" id="note" name="note" rows="5" 
                  placeholder="Add note" value="{{ old('note') }}"></textarea>
                  @error('note')
                  <div class="alert alert-danger mt-2">
                    {{ $message }}
                    </div>
                  @enderror
                </div>   
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
	      <button type="button" class="btn btn-secondary" onClick="Close()">Cancel</button>
        <button type="submit" class="btn btn-primary" id="storeapprove">Submit</button>
        </form>
    </div>
<!-- End Modals Approve -->

