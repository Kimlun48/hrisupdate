<div class="p2">
<form id="myform" enctype="multipart/form-data">
   @csrf
      <div class="mb-3 row row-body">
         <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Resign Date</label>
         <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
            <input type="date" class="ms-1 form-control form-control-sm col-form-input @error('tanggal_pengajuan') is-invalid @enderror" name="tanggal_pengajuan"
               value="{{ old('tanggal_pengajuan') }}" style="width: 360px;">

            <!-- error message untuk title -->
            @error('tanggal_pengajuan')
               <div class="alert alert-danger mt-2">
                     {{ $message }}
               </div>
            @enderror
         </div>
      </div>

      <div class="mb-3 row row-body">
         <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Last Work</label>
         <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
            <input type="date" class="ms-1 form-control form-control-sm col-form-input @error('tanggal_akhirkerja') is-invalid @enderror" name="tanggal_akhirkerja"
               value="{{ old('tanggal_akhirkerja') }}" style="width: 360px;">

            <!-- error message untuk title -->
            @error('tanggal_akhirkerja')
               <div class="alert alert-danger mt-2">
                     {{ $message }}
               </div>
            @enderror
         </div>
      </div>

      <div class="mb-3 row row-body">
         <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Reason</label>
         <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
               <div class="form-group">
               <textarea type="text" class="ms-1 form-control form-control-sm col-form-input @error('keterangan') is-invalid @enderror" name="reason"
               value="{{ old('reason') }}" style="width: 360px;"></textarea>
            <!-- error message untuk title -->
            @error('reason')
               <div class="alert alert-danger mt-2">
                     {{ $message }}
               </div>
            @enderror
               </div>
         </div>
      </div>

      <div class="mb-3 row row-body">
         <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Document</label>
         <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
            <input type="file" class="ms-1 form-control form-control-sm col-form-input @error('dokumen') is-invalid @enderror" name="dokumen"
               value="{{ old('dokumen') }}" style="width: 360px;">

            <!-- error message untuk title -->
            @error('dokumen')
               <div class="alert alert-danger mt-2">
                     {{ $message }}
               </div>
            @enderror

         </div>
      </div>

      <div class="mb-3 row row-body">
         <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
            <input type="hidden" id="id_karyawan" name="id_karyawan" class="ms-1 form-control form-control-sm col-form-input" value="{{ auth()->user()->getkaryawan->id}}"
            style="width: 360px;">
         </div>
      </div>


         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="Close()" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="store()">Request</button>
         </div>
   </form>
</div>  
