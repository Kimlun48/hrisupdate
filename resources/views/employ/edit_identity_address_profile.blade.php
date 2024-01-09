<div class="p2">
   <form id="myform" enctype="multipart/form-data">
      @csrf
         <div class="mb-3 row row-body">
            <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">ID Type</label>
            <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
               <input type="text" class="ms-1 form-control" name="tipe_identitas" value="KTP">
               <!-- error message untuk title -->
               @error('tipe_identitas')
                  <div class="alert alert-danger mt-2">
                        {{ $message }}
                  </div>
               @enderror
            </div>
         </div>
         <div class="mb-3 row row-body">
            <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">ID Number</label>
            <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
               <input type="text" class="ms-1 form-control" name="no_identitas" value="{{$data->no_identitas}}">
               <!-- error message untuk title -->
               @error('no_identitas')
                  <div class="alert alert-danger mt-2">
                        {{ $message }}
                  </div>
               @enderror
            </div>
         </div>
         <div class="mb-3 row row-body">
            <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">ID Expiration Date</label>
            <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
               <input type="text" class="ms-1 form-control" name="expired_identitas" value="Permanent">
               <!-- error message untuk title -->
               @error('expired_identitas')
                  <div class="alert alert-danger mt-2">
                        {{ $message }}
                  </div>
               @enderror
            </div>
         </div>
         <div class="mb-3 row row-body">
            <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Postal Code</label>
            <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
               <input type="text" class="ms-1 form-control" name="kodepos" value="{{$data->kodepos}}">
               <!-- error message untuk title -->
               @error('kodepos')
                  <div class="alert alert-danger mt-2">
                        {{ $message }}
                  </div>
               @enderror
            </div>
         </div>
   
         <div class="mb-3 row row-body">
            <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Address</label>
            <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
               <input type="text" class="ms-1 form-control" name="alamat" value ="{{$data->alamat}}">
               <!-- error message untuk title -->
               @error('alamat')
                  <div class="alert alert-danger mt-2">
                        {{ $message }}
                  </div>
               @enderror
            </div>
         </div>
   
         
   
         <div class="mb-3 row row-body">
            <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
               <input type="hidden" readonly id="id_kar" name="id_kar" class="ms-1 form-control col-form-input" value="{{ $data->id}}">
            </div>
         </div>
         </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" onclick="Close()" data-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary" onclick="save_identity_and_address()">Simpan</button>
            </div>
      </form>
   </div>  
   