<div class="p2">
   <form id="myform" enctype="multipart/form-data">
      @csrf

      <div class="row text-uppercase">
         <!-- Left column -->
         <div class="col-md-6">

            <div class="form-group">
               <label class="col-form-label">Company Name</label>
               <select class="select col-form-input @error('fk_nama_perusahaan') is-invalid @enderror" id="fk_nama_perusahaan" name="fk_nama_perusahaan">
               <option value="" selected disabled>---Pilih---</option>
               @foreach ($pt as $pts)
                  <option value="{{ $pts->id }}" {{ $pts->id == $data->cabang->perusahaan->id  ? 'selected' :''}}>{{ $pts->nama }}</option>
               @endforeach
               </select>
      
               <!-- error message untuk title -->
               @error('fk_nama_perusahaan')
                  <div class="alert alert-danger mt-2">
                        {{ $message }}
                  </div>
               @enderror
            </div>
   

            <div class="form-group">
               <label class="col-form-label">Employment ID</label>
               <input type="text" id="nik" name="nik" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()" value="{{ $data->nomor_induk_karyawan }}" style="width: 100%;">
               @error('nik')
               <div class="alert alert-danger mt-2">{{ $message }}</div>
               @enderror
            </div>


            <div class="form-group">
               <label class="col-form-label">Job Position</label>
               <select class="select col-form-input @error('fk_level_jabatan') is-invalid @enderror" id="fk_level_jabatan" name="fk_level_jabatan">
                  <option value="" selected disabled>---Pilih---</option>
                  @foreach ($jabatan as $pts)
                     <option value="{{ $pts->id }}" {{ $pts->id == $data->jabatan->id  ? 'selected' :''}}>{{ $pts->nama }}</option>
                  @endforeach
               </select>
      
               <!-- error message untuk title -->
               @error('fk_level_jabatan')
                  <div class="alert alert-danger mt-2">
                        {{ $message }}
                  </div>
               @enderror
            </div>



            <div class="form-group">
               <label class="col-form-label" for="tahun_gabung">Join Date</label>
               <input class="form-control form-control-sm" id="tahun_gabung" name="tahun_gabung" type="date" value="{{ \Carbon\Carbon::parse($data->tahun_gabung)->format('Y-m-d') }}" placeholder="dd-mm-yyyy" required>
           </div>
           
            <!-- Add other left column fields here -->
         </div>
         

         <!-- Right column -->
         <div class="col-md-6">

            
            <div class="form-group">
               <label class="col-form-label">Cabang</label>
               <select class="select col-form-input @error('fk_cabang') is-invalid @enderror" id="fk_cabang" name="fk_cabang">
         
               <option value="" selected disabled>---Pilih---</option>
               @foreach ($cabs as $pts)
                  <option value="{{ $pts->id }}" {{ $pts->id == $data->cabang->id  ? 'selected' :''}}>{{ $pts->nama }}</option>
               @endforeach
               </select>
      
               <!-- error message untuk title -->
               @error('fk_cabang')
                  <div class="alert alert-danger mt-2">
                        {{ $message }}
                  </div>
               @enderror
            </div>

            <div class="form-group">
               <label class="col-form-label">Organization Name</label>
               <select class="select col-form-input @error('fk_bagian') is-invalid @enderror" id="fk_bagian" name="fk_bagian">
                  <option value="" selected disabled>---Pilih---</option>
               @foreach ($bagian as $pts)
                  <option value="{{ $pts->id }}" {{ $pts->id == $data->bagian->id  ? 'selected' :''}}>{{ $pts->nama }}</option>
               @endforeach
               </select>
      
               <!-- error message untuk title -->
               @error('fk_bagian')
                  <div class="alert alert-danger mt-2">
                        {{ $message }}
                  </div>
               @enderror
            </div>

            <div class="form-group">
               <label class="col-form-label">Status Karwayan</label>
               <select class="select col-form-input @error('status_karyawan') is-invalid @enderror" id="status_karyawan" name="status_karyawan">            
                  <option value="{{ $data->status_karyawan }}" {{ $data->status_karyawan == $data->status_karyawan  ? 'selected' :''}}>{{ $data->status_karyawan }}</option>
                  <option value="Permanent" >Permanent</option>
                  <option value="Probation" >Probation</option>
                  <option value="Contract" >Contract</option>
                  <option value="PHL" >PHL</option>
                  <option value="AKTIF" >AKTIF</option>
               </select>
      
               <!-- error message untuk title -->
               @error('status_karyawan')
                  <div class="alert alert-danger mt-2">
                        {{ $message }}
                  </div>
               @enderror
            </div>

            <div class="form-group">
               <label class="col-form-label" for="tahun_keluar">End Date</label>
               <input class="form-control form-control-sm" id="tahun_keluar" name="tahun_keluar" type="date" 
                  value="{{ $data->tahun_keluar ? \Carbon\Carbon::parse($data->tahun_keluar)->format('Y-m-d') : '' }}" 
                  placeholder="dd-mm-yyyy" 
                  @if(!$data->tahun_keluar)  
                  @endif>
            </div>
           

            <div class="mb-3 row row-body" hidden>
               <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                  <input type="hidden" readonly id="id" name="id_kar" class="ms-1 form-control form-control-sm col-form-input" value="{{ $data->id}}"
                  style="width: 360px;">
               </div>
            </div>
            <!-- Add other right column fields here -->
         </div>
      </div>


      <!-- Continue adding rows and columns as needed -->

      <div class="modal-footer">
         <button type="button" class="btn btn-secondary" onclick="Close()" data-dismiss="modal">Close</button>
         <button type="button" class="btn btn-primary" onclick="saveedit_employ_data()">Simpan</button>
      </div>

   </form>
</div>


<script>
   $(".select").selectize({
      plugins: ["restore_on_backspace"],
   });
</script>

