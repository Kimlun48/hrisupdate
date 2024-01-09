<div class="p2">
   <form id="myform" enctype="multipart/form-data">
      @csrf

      <div class="row text-uppercase">
         <!-- Left column -->
         <div class="col-md-4">

            <div class="form-group">
               <label class="col-form-label">Nama</label>
               <input type="text" readonly id="id" name="nama_lengkap" class="form-control form-control-sm" value="{{ $data->nama_lengkap }}" oninput="this.value = this.value.toUpperCase()" style="width: 100%;">
               @error('nama_lengkap')
                  <div class="alert alert-danger mt-2">{{ $message }}</div>
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
               <label class="col-form-label" for="Email">Email</label>
               <input class="form-control form-control-sm" placeholder="Email..." id="Email" name="email" type="email"
               value="{{$data->email}}">
            </div>


            <div class="form-group">
               <label class="col-form-label" for="gender">Gender</label>
               <select class="select col-form-input" id="gender" name="gender">
                  <option selected disabled value="{{ $data->gender }}" {{ $data->gender == $data->gender  ? 'selected' :''}}>{{ $data->gender }}</option>
                  <option value="laki-laki">Laki-Laki</option>
                  <option value="perempuan">Perempuan</option>
               </select>
            </div>

            <!-- Add other left column fields here -->
         </div>
         
         {{-- middle column --}}
         <div class="col-md-4">

            <div class="form-group">
               <label class="col-form-label">NIK</label>
               <input type="text" id="nik" name="nik" class="form-control form-control-sm" oninput="this.value = this.value.toUpperCase()" value="{{ $data->nomor_induk_karyawan }}" style="width: 100%;">
               @error('nik')
               <div class="alert alert-danger mt-2">{{ $message }}</div>
               @enderror
            </div>
            
            <div class="form-group">
               <label class="col-form-label">Religion</label>
               <select class="select col-form-input @error('agama') is-invalid @enderror" id="agama" name="agama">
      
                  <option value="{{ $data->agama}}">{{ $data->agama}}</option>
                  <option value="Islam">Islam</option>
                  <option value="Protestan">Protestan</option>
                  <option value="Katolik">katolik</option>
                  <option value="Budha">Budha</option>
                  <option value="Hindu">Hindu</option>
                  <option value="Konghucu">Konghucu</option>
               </select>
      
               <!-- error message untuk title -->
               @error('agama')
                  <div class="alert alert-danger mt-2">
                        {{ $message }}
                  </div>
               @enderror
            </div>

            <div class="form-group">
               <label class="col-form-label" for="pernikahan">Martial Status</label>
               <select class="select col-form-input" id="pernikahan" name="status_pernikahan">
                  <option selected disabled value="{{ $data->status_pernikahan}}">{{ $data->status_pernikahan}}</option>
                  <option value="Belum menikah">Belum menikah</option>
                  <option value="Menikah">Menikah</option>
                  <option value="Duda">Duda</option>
                  <option value="Janda">Janda</option>
               </select>
            </div>

            <div class="form-group">
               <label class="col-form-label" for="tgl_lahir">Birth Date</label>
               <input class="form-control form-control-sm" placeholder="Date Of Birth..." id="tgl_lahir" name="tgl_lahir" type="date" value="{{$data->tgl_lahir}}">
            </div>

            <div class="form-group">
               <label class="col-form-label" for="darah">Blood Type</label>
               <select class="select col-form-input" id="darah"  name="golongan_darah">
                  <option selected disabled value="{{ $data->golongan_darah }}" {{ $data->golongan_darah == $data->golongan_darah  ? 'selected' :''}}>{{ $data->golongan_darah }}</option>
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="AB">AB</option>
                  <option value="O">O</option>
               </select>
            </div>

         </div>

         <!-- Right column -->
         <div class="col-md-4">

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
               <label class="col-form-label">Position</label>
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
               <label class="col-form-label">Company</label>
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
               <label class="col-form-label" for="phone">Mobile Phone</label>
               <input class="form-control form-control-sm" placeholder="Phone number..." id="phone" name="no_hp" type="number" pattern="[^()/><\][\\\x22,;|]+" maxlength="15"
               value="{{$data->no_hp}}">
            </div>

            <div class="form-group">
               <label class="col-form-label" for="tempat_lahir">Place Of Birth</label>
               <input class="form-control form-control-sm" placeholder="City of birth..." oninput="this.value = this.value.toUpperCase()"  name="tempat_lahir" type="text" pattern="[^()/><\][\\\x22,;|]+"
               value="{{ $data->tempat_lahir}}">
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

      <div class="col-md-12">
         <div class="form-group">
            <label for="alamat">Address</label>
            <input class="form-control form-control-sm" placeholder="Address..." oninput="this.value = this.value.toUpperCase()"  name="alamat" type="text" pattern="[^()/><\][\\\x22,;|]+"
            value="{{ $data->alamat }}">
         </div>
      </div>

      <!-- Continue adding rows and columns as needed -->

      <div class="modal-footer">
         <button type="button" class="btn btn-secondary" onclick="Close()" data-dismiss="modal">Close</button>
         <button type="button" class="btn btn-primary" onclick="storeedit()">Simpan</button>
      </div>

   </form>
</div>


<script>
   $(".select").selectize({
      plugins: ["restore_on_backspace"],
   });
</script>