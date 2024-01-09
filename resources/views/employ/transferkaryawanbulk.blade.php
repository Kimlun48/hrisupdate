<div class="p2">
<form id="myform" enctype="multipart/form-data">
   @csrf

   <!-- old value -->
   <div class="mb-3 row row-body bg-light">
      <h4 class="text-center mt-3 mb-2">Data Awal</h4>

      <div class="row mb-3">
         <div class="col col-md-auto mb-2">
            <label class="col-sm-6 col-md-6 col-lg-12 col-xl-12 col-form-label" style="font-size: 15px;">Nama Lengkap</label>
            <div class="col col-md-auto">
               {{ $data->nama_lengkap }}
            </div>
         </div>
         <div class="col col-md-auto mb-2">
            <label class="col-sm-6 col-md-6 col-lg-12 col-xl-12 col-form-label" style="font-size: 15px;">NIK</label>
            <div class="col col-md-auto">
               {{ $data->nomor_induk_karyawan }}
            </div>
         </div>
      </div>
      
      <div class="col col-md-auto mb-2">
         <label class="col-sm-6 col-md-6 col-lg-12 col-xl-12 col-form-label" style="font-size: 15px;">Perusahaan</label>
         <div class="col col-md-auto">
            {{ $data->cabang->perusahaan->nama }}
         </div>
      </div>
      <div class="col col-md-auto mb-2">
         <label class="col-sm-6 col-md-6 col-lg-12 col-xl-12 col-form-label" style="font-size: 15px;">Cabang</label>
         <div class="col col-md-auto">
            {{ $data->cabang->nama }}
         </div>
      </div>
      <div class="col col-md-auto mb-2">
         <label class="col-sm-6 col-md-6 col-lg-12 col-xl-12 col-form-label" style="font-size: 15px;">Bagian</label>
         <div class="col col-md-auto">
            {{ $data->bagian->nama }}
         </div>
      </div>
      <div class="col col-md-auto mb-2">
         <label class="col-sm-6 col-md-6 col-lg-12 col-xl-12 col-form-label" style="font-size: 15px;">Level Jabatan</label>
         <div class="col col-md-auto">
            {{ $data->jabatan->nama }}
         </div>
      </div>
      <div class="col col-md-auto mb-2">
         <label class="col-sm-6 col-md-6 col-lg-12 col-xl-12 col-form-label" style="font-size: 15px;">Status karyawan</label>
         <div class="col col-md-auto">
            {{ $data->status_karyawan }}
         </div>
      </div>
   </div>
   
   <!-- input transfer -->
   <div class="mb-3 row row-body">

      <div class="row mb-4">
         <div class="col col-md-auto mb-2">
            <label class="col-sm-6 col-md-6 col-lg-12 col-xl-12 col-form-label">Transfer</label>
            <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10" style="width: 200px;">
               <select class="form-control form-control-sm col-form-input @error('type') is-invalid @enderror" id="type" name="type">
                  <option value="Mutasi">Mutasi</option>
                  <option value="Promosi">Promosi</option>
                  <option value="Demosi">Demosi</option>
                  <option value="Extend Contract">Extend Contract</option>
                  <option value="Rotasi">Rotasi</option>
               </select>
               @error('type')
                  <div class="alert alert-danger mt-2">
                        {{ $message }}
                  </div>
               @enderror
            </div>
         </div>

         <div class="col col-md-auto mb-2">
            <label class="col-sm-6 col-md-6 col-lg-12 col-xl-12 col-form-label">Tanggal Transfer</label>
            <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10" style="width: 200px;">
               <input type="date" name="tgl_transfer" class="ms-1 form-control form-control-sm col-form-input" value="{{ $data->tgl_transfer}}">
               @error('tgl_transfer')
                  <div class="alert alert-danger mt-2">
                        {{ $message }}
                  </div>
               @enderror
            </div>
         </div>
      </div>

      <div class="col col-md-auto mb-2">
         <label class="col-sm-6 col-md-6 col-lg-12 col-xl-12 col-form-label">Perusahan</label>
         <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10" style="width: 200px;">
            <select class="form-control form-control-sm col-form-input @error('fk_nama_perusahaan') is-invalid @enderror" id="fk_nama_perusahaan" name="fk_nama_perusahaan">
               <option value="" selected disabled>---Pilih---</option>
               @foreach ($pt as $pts)
                  <option value="{{ $pts->id }}" {{ $pts->id == $data->cabang->perusahaan->id  ? 'selected' :''}}>{{ $pts->nama }}</option>
               @endforeach
            </select>
            @error('fk_nama_perusahaan')
               <div class="alert alert-danger mt-2">
                     {{ $message }}
               </div>
            @enderror
         </div>
      </div>

      <div class="col col-md-auto mb-2">
         <label class="col-sm-6 col-md-6 col-lg-12 col-xl-12 col-form-label" style="">Cabang</label>
         <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10" style="width: 200px;">
            <select class="form-control form-control-sm col-form-input @error('fk_cabang') is-invalid @enderror" id="fk_cabang" name="fk_cabang">
               <option value="" selected disabled>---Pilih---</option>
               @foreach ($cabs as $pts)
                  <option value="{{ $pts->id }}" {{ $pts->id == $data->cabang->id  ? 'selected' :''}}>{{ $pts->nama }}</option>
               @endforeach
            </select>

            @error('fk_cabang')
               <div class="alert alert-danger mt-2">
                     {{ $message }}
               </div>
            @enderror
         </div>
      </div>

      <div class="col col-md-auto mb-2">
         <label class="col-sm-6 col-md-6 col-lg-12 col-xl-12 col-form-label">Bagian</label>
         <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10" style="width: 200px;">
            <select class="form-control form-control-sm col-form-input @error('fk_bagian') is-invalid @enderror" id="fk_bagian" name="fk_bagian">
               <option value="" selected disabled>---Pilih---</option>
               @foreach ($bagian as $pts)
                  <option value="{{ $pts->id }}" {{ $pts->id == $data->bagian->id  ? 'selected' :''}}>{{ $pts->nama }}</option>
               @endforeach
            </select>

            @error('fk_bagian')
               <div class="alert alert-danger mt-2">
                     {{ $message }}
               </div>
            @enderror
         </div>
      </div>

      <div class="col col-md-auto mb-2">
         <label class="col-sm-6 col-md-6 col-lg-12 col-xl-12 col-form-label">Level Jabatan</label>
         <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10" style="width: 200px;">
            <select class="form-control form-control-sm col-form-input @error('fk_level_jabatan') is-invalid @enderror" id="fk_level_jabatan" name="fk_level_jabatan">
               <option value="" selected disabled>---Pilih---</option>
               @foreach ($jabatan as $pts)
                  <option value="{{ $pts->id }}" {{ $pts->id == $data->jabatan->id  ? 'selected' :''}}>{{ $pts->nama }}</option>
               @endforeach
            </select>
            @error('fk_level_jabatan')
               <div class="alert alert-danger mt-2">
                     {{ $message }}
               </div>
            @enderror
         </div>
      </div>

      <div class="col col-md-auto mb-2">
         <label class="col-sm-6 col-md-6 col-lg-12 col-xl-12 col-form-label">Status Karwayan</label>
         <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10" style="width: 200px;">
            <select class="form-control form-control-sm col-form-input @error('status_karyawan') is-invalid @enderror" id="status_karyawan" name="status_karyawan">            
               <option value="{{ $data->status_karyawan }}" {{ $data->status_karyawan == $data->status_karyawan  ? 'selected' :''}}>{{ $data->status_karyawan }}</option>
               <option value="Permanent">Permanent</option>
               <option value="Contract">Contract</option>
               <option value="Probation">Probation</option>
            </select>
            @error('status_karyawan')
               <div class="alert alert-danger mt-2">
                     {{ $message }}
               </div>
            @enderror
         </div>
      </div>
      
   </div>

   <div class="mb-3 ms-2 row row-body">
      <label class="col-sm-6 col-md-6 col-lg-12 col-xl-12 col-form-label">Keterangan</label>
      <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
         <textarea name="keterangan" id="keterangan" cols="0" rows="5" style="height: 100px; width: 500px;"></textarea>
         <!-- error message untuk title -->
         @error('keterangan')
            <div class="alert alert-danger mt-2">
                  {{ $message }}
            </div>
         @enderror
      </div>
   </div>


<!-- 
   <div class="mb-3 row row-body">
      <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Content <span class="wajib">*</span></label>
      <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
      <textarea class="form-control col-form-input  @error('content') is-invalid @enderror" id="content" name="content" row="15"
            placeholder="Add Content" value="{{ old('content') }}"></textarea>
      @error('content')
         <div class="alert alert-danger mt-2">
               {{ $message }}
         </div>
      @enderror
      
      </div>
   </div> -->
   <div class="mb-3 row row-body">
      <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10" style="width: 200px;">
         <input type="hidden" readonly id="id" name="id_karyawan" class="ms-1 form-control form-control-sm col-form-input" value="{{ $data->id}}"
         style="width: 360px;">
      </div>
   </div>

   <div class="modal-footer">
      <button type="button" class="btn btn-secondary" onclick="Close()" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" onclick="storetransfer()">Simpan</button>
   </div>

</form>
</div> 

<script>

   
    ClassicEditor
    .create( document.querySelector( '#keterangan' ) )
    .catch( error => {
        console.log( error );
    } );
</script>

