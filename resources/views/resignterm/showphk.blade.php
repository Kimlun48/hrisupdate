<div class="p2">
<form id="myform" enctype="multipart/form-data">
   @csrf
      <div class="mb-3 row row-body">
         <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Nama</label>
         <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
            <input type="text" readonly class="ms-1 form-control form-control-sm" name="nama"
               value="{{$data->nama_lengkap}}" style="width: 360px;">
            <!-- error message untuk title -->
            @error('nama')
               <div class="alert alert-danger mt-2">
                     {{ $message }}
               </div>
            @enderror
         </div>
      </div>
      <div class="mb-3 row row-body">
         <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Nik</label>
         <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
            <input type="text" readonly class="ms-1 form-control form-control-sm" name="nik"
               value="{{$data->nomor_induk_karyawan}}" style="width: 360px;">
            <!-- error message untuk title -->
            @error('nik')
               <div class="alert alert-danger mt-2">
                     {{ $message }}
               </div>
            @enderror
         </div>
      </div>

      <div class="mb-3 row row-body">
         <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">status</label>
         <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">   
         <select name="stsapp" id="stsapp" class="ms-1 form-control form-control-sm col-form-input"  style="width: 360px;">
           <option value="phk">PHK</option>
           <option value="Resign">Resign</option>
           <option value="habiskontrak">Habis Kontrak</option>
        </select>
       </div>
      </div>

      <div class="mb-3 row row-body">
         <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Tgl Pengajuan</label>
         <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
            <input type="date" class="ms-1 form-control form-control-sm" name="tanggal_pengajuan" style="width: 360px;">
            <!-- error message untuk title -->
            @error('tanggal_pengajuan')
               <div class="alert alert-danger mt-2">
                     {{ $message }}
               </div>
            @enderror
         </div>
      </div>

      <div class="mb-3 row row-body">
         <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Tgl Akhir</label>
         <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
            <input type="date" class="ms-1 form-control form-control-sm" name="tanggal_akhirkerja" style="width: 360px;">
            <!-- error message untuk title -->
            @error('tanggal_akhirkerja')
               <div class="alert alert-danger mt-2">
                     {{ $message }}
               </div>
            @enderror
         </div>
      </div>

      <div class="mb-3 row row-body">
         <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Ket</label>
         <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
               <div class="form-group">
               <textarea type="text" class="ms-1 form-control form-control-sm col-form-input @error('keterangan') is-invalid @enderror" name="keterangan" style="width: 360px;"></textarea>
            <!-- error message untuk title -->
            @error('keterangan')
               <div class="alert alert-danger mt-2">
                     {{ $message }}
               </div>
            @enderror
               </div>
         </div>
      </div>
      <div class="mb-3 row row-body">
         <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
            <input type="hidden" readonly id="id_req" name="id_req" class="ms-1 form-control form-control-sm col-form-input" value="{{ $data->id}}"
            style="width: 360px;">
         </div>
      </div>
      </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="Close()" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="storephk()">Simpan</button>
         </div>
   </form>
</div>  
