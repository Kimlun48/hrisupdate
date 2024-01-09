
<div class="p2">
<form id="myform" enctype="multipart/form-data">
   @csrf
   
   <!-- input transfer -->

<div class="form-row align-items-center">
   <div class="form-group col-md-12">
      <label class="mr-sm-2" for="inlineFormCustomSelect">Employee</label>
      <select id="mySelect" multiple id="karyawan" name="karyawan[]" custom-select mr-sm-2>
         @foreach ($kr as $krs)
           <option value="{{ $krs->id }}">{{ $krs->nomor_induk_karyawan }}-{{ $krs->nama_lengkap }}</option>
         @endforeach
      </select>
         @error('karyawan')
            <div class="alert alert-danger mt-2">
               {{ $message }}
            </div>
         @enderror
   </div>

   <div class="form-group col-md-12">
      <label class="mr-sm-2" for="tgl_transfer">Over Time Date* </label>
      <!-- <input type="text" name="overtime_date" class="ms-1 form-control form-control-sm col-form-input datepicker"> -->
      <input type="text" class="form-control datepicker" name="tanggal_overtime" id="tanggal_overtime">
         @error('overtime_date')
            <div class="alert alert-danger mt-2">
               {{ $message }}
            </div>
         @enderror
   </div>
   


   <!-- <div class="form-group col-md-6">
      <label class="mr-sm-2" for="fk_level_jabatan">Duration Over Time*</label>
      <input type="text" class="timepicker form-control" name="durasi" onclick="timepickersepur()"/>
         @error('durasi')
            <div class="alert alert-danger mt-2">
                  {{ $message }}
            </div>
         @enderror
   </div> -->

   <div class="form-group col-md-6">
      <label class="mr-sm-2" for="mulai">Start Over Time*</label>
      <input type="text" class="timepicker form-control" name="mulai" onclick="timepickersepur()"/>
         <!-- error message untuk title -->
         @error('mulai')
            <div class="alert alert-danger mt-2">
                  {{ $message }}
            </div>
         @enderror
</div>
<div class="form-group col-md-6">
      <label class="mr-sm-2" for="akhir">End Over Time*</label>
      <input type="text" class="timepicker form-control" name="akhir" onclick="timepickersepur()"/>
         <!-- error message untuk title -->
         @error('akhir')
            <div class="alert alert-danger mt-2">
                  {{ $message }}
            </div>
         @enderror
</div>

   <div class="form-group col-md-6">
      <label class="mr-sm-2" for="kompensasi">Kompensasi </label>
      <select class="form-control form-control-sm col-form-input @error('kompensasi') is-invalid @enderror" id="kompensasi" name="kompensasi">            
               <option value="" selected disabled>---Pilih---</option>
               <option value="Paid">Paid</option>
               <option value="Off">Off</option>
            </select>
            @error('kompensasi')
               <div class="alert alert-danger mt-2">
                     {{ $message }}
               </div>
            @enderror
   </div>


   <div class="form-group col-md-6">
      <label class="mr-sm-2" for="note">Note*</label>
      <textarea name="note" id="note" class="form-control"></textarea>
         <!-- error message untuk title -->
         @error('note')
            <div class="alert alert-danger mt-2">
                  {{ $message }}
            </div>
         @enderror
   </div>
</div>


   <div class="modal-footer">
      <button type="button" class="btn btn-secondary" onclick="Close()" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" onclick="storeovertime()">Simpan</button>
   </div>
   

</form>
</div> 

<script>

//Date Picker
  $(function() {
    // Inisialisasi datepicker
    $(".datepicker").datepicker({
      changeMonth: true, // Enable month dropdown
      changeYear: true,
      dateFormat: "dd-mm-yy", // Format tampilan tanggal
      altFormat: "dd-mm-yy", // Format tanggal yang akan disubmit (dapat disesuaikan sesuai kebutuhan)
      altField: "#datepicker", // ID elemen input yang akan menerima tanggal yang diformat
    });
  });
</script>



