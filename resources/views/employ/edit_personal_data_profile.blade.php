<div class="p2">
   <form id="myform" enctype="multipart/form-data">
      @csrf
         <div class="mb-3 row row-body">
            <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Full Name</label>
            <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
               <input type="text" class="ms-1 form-control" name="nama"
                  value="{{$data->nama_lengkap}}">
               <!-- error message untuk title -->
               @error('nama')
                  <div class="alert alert-danger mt-2">
                        {{ $message }}
                  </div>
               @enderror
            </div>
         </div>
         <div class="mb-3 row row-body">
            <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Mobile Phone</label>
            <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
               <input type="text" class="ms-1 form-control" name="mobile_phone"
                  value="{{$data->no_hp}}">
               <!-- error message untuk title -->
               @error('mobile_phone')
                  <div class="alert alert-danger mt-2">
                        {{ $message }}
                  </div>
               @enderror
            </div>
         </div>
         <div class="mb-3 row row-body">
            <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Phone</label>
            <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
               <input type="text" class="ms-1 form-control" name="no_telp"
                  value="{{$data->no_telp}}">
               <!-- error message untuk title -->
               @error('no_telp')
                  <div class="alert alert-danger mt-2">
                        {{ $message }}
                  </div>
               @enderror
            </div>
         </div>
         <div class="mb-3 row row-body">
            <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Email</label>
            <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
               <input type="text" class="ms-1 form-control" name="email" value="{{$data->email}}">
               <!-- error message untuk title -->
               @error('email')
                  <div class="alert alert-danger mt-2">
                        {{ $message }}
                  </div>
               @enderror
            </div>
         </div>
   
         <div class="mb-3 row row-body">
            <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Place Of Birth</label>
            <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
               <input type="text" class="ms-1 form-control" name="tempat_lahir" value ="{{$data->tempat_lahir}}">
               <!-- error message untuk title -->
               @error('tempat_lahir')
                  <div class="alert alert-danger mt-2">
                        {{ $message }}
                  </div>
               @enderror
            </div>
         </div>
   
         <div class="mb-3 row row-body">
            <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Birth Date</label>
            <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
               <input type="date" class="ms-1 form-control" name="tgl_lahir" value="{{$data->tgl_lahir}}">
               <!-- error message untuk title -->
               @error('tgl_lahir')
                  <div class="alert alert-danger mt-2">
                        {{ $message }}
                  </div>
               @enderror
            </div>
         </div>
   
   
         <div class="mb-3 row row-body">
            <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Gender</label>
            <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
               <select class="ms-1 select" name="gender" >
                  <option value="Laki-laki" {{ ($data->gender == 'Laki-lak') ? 'selected' : '' }}>Laki-laki</option>
                  <option value="Perempuan" {{ ($data->gender == 'Perempuan') ? 'selected' : '' }}>Perempuan</option>
              </select>
               <!-- error message untuk title -->
               @error('gender')
                  <div class="alert alert-danger mt-2">
                        {{ $message }}
                  </div>
               @enderror
            </div>
         </div>
   
   
         <div class="mb-3 row row-body">
            <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Martial Status</label>
            <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
               <select class="ms-1 select" name="status_pernikahan" >
                  <option value="Belum Menikah" {{ ($data->status_pernikahan == 'Belum Menikah' || $data->status_pernikahan == 'BELUM KAWIN' || $data->status_pernikahan == 'Single') ? 'selected' : '' }}>Belum Menikah</option>
                  <option value="Menikah" {{ ($data->status_pernikahan == 'Married' || $data->status_pernikahan == "Menikah" || $data->status_pernikahan == 'MENIKAH') ? 'selected' : '' }}>Menikah</option>
                  <option value="Duda" {{ ($data->status_pernikahan == 'Duda') ? 'selected' : '' }}>Duda</option>
                  <option value="Janda" {{ ($data->status_pernikahan == 'Perempuan') ? 'selected' : '' }}>Janda</option>
                  <option value="Cerai" {{ ($data->status_pernikahan == 'Perempuan') ? 'selected' : '' }}>Cerai</option>
              </select>
               <!-- error message untuk title -->
               @error('status_pernikahan')
                  <div class="alert alert-danger mt-2">
                        {{ $message }}
                  </div>
               @enderror
            </div>
         </div>
   
   
         <div class="mb-3 row row-body">
            <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Blood Type</label>
            <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
               <select class="ms-1 select" name="golongan_darah" >
                  <option value="-" {{ ($data->golongan_darah == '-') ? 'selected' : '' }}>-</option>
                  <option value="O" {{ ($data->golongan_darah == 'O' || $data->golongan_darah == "0" ) ? 'selected' : '' }}>O</option>
                  <option value="A" {{ ($data->golongan_darah == 'A') ? 'selected' : '' }}>A</option>
                  <option value="B" {{ ($data->golongan_darah == 'B') ? 'selected' : '' }}>B</option>
                  <option value="AB" {{ ($data->golongan_darah == 'AB') ? 'selected' : '' }}>AB</option>
              </select>
               <!-- error message untuk title -->
               @error('golongan_darah')
                  <div class="alert alert-danger mt-2">
                        {{ $message }}
                  </div>
               @enderror
            </div>
         </div>
   
         <div class="mb-3 row row-body">
            <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Religion</label>
            <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
               <select class="ms-1 select" name="agama" >
                  <option value="Islam" {{ ($data->agama == 'Islam') ? 'selected' : '' }}>Islam</option>
                  <option value="Kristen" {{ ($data->agama == 'Kristen' || $data->agama == 'Kirsten' ) ? 'selected' : '' }}>Kristen</option>
                  <option value="Katolik" {{ ($data->agama == 'Katolik') ? 'selected' : '' }}>Katolik</option>
                  <option value="Hindu" {{ ($data->agama == 'Hindu') ? 'selected' : '' }}>Hindu</option>
                  <option value="Budha" {{ ($data->agama == 'Budha') ? 'selected' : '' }}>Budha</option>
                  <option value="Protestan" {{ ($data->agama == 'Protestan') ? 'selected' : '' }}>Protestan</option>
              </select>
               <!-- error message untuk title -->
               @error('agama')
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
               <button type="button" class="btn btn-primary" onclick="storepersonalprofil()">Simpan</button>
            </div>
         </div>
   </form>
</div>  
   
<script>
   $(".select").selectize({
      plugins: ["restore_on_backspace"],
   });
</script>