<div class="p2">
<form id="myform" enctype="multipart/form-data">
   @csrf
   
   <!-- input transfer -->

<div class="form-row align-items-center">
   <div class="form-group col-md-12">
      <label class="mr-sm-2">Employee</label>
      <!-- <input class="form-control" id ="inputku" type="text" name="karyawan[]">
         @error('karyawan')
            <div class="alert alert-danger mt-2">
               {{ $message }}
            </div>
         @enderror -->


      <textarea name="karyawan[]" id="inputku" cols="0" rows="5" style="height: 100px; width: 1000px;" readonly></textarea>
         <!-- error message untuk title -->
         @error('keterangan')
            <div class="alert alert-danger mt-2">
                  {{ $message }}
            </div>
         @enderror

   </div>
   <div class="form-group col-md-12">
      <label class="mr-sm-2" for="tgl_transfer">Effective date* </label>
      <input type="text" name="tgl_transfer" class="ms-1 form-control form-control-sm col-form-input datepicker">

      
      <!-- <input type="date" name="tgl_transfer" class="ms-1 form-control form-control-sm col-form-input"> -->
         @error('tgl_transfer')
            <div class="alert alert-danger mt-2">
               {{ $message }}
            </div>
         @enderror
   </div>


   <div class="form-group col-md-12" >
      <label class="mr-sm-2" for="type">Transfer Type*</label>
      <select class="form-control form-control-sm col-form-input @error('type') is-invalid @enderror" id="type" name="type">
         <option value="" selected disabled>---Pilih---</option>
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


   <div class="form-group col-md-6">
      <label class="mr-sm-2" for="status_karyawanchoice">Employment status</label>
      <select class="form-control form-control-sm col-form-input @error('status_karyawanchoice')
           is-invalid @enderror" id="status_karyawanchoice" name="status_karyawanchoice">            
               <option value="" selected disabled>---Pilih---</option>
               <option value="Permanent">Permanent</option>
               <option value="Contract">Contract</option>
               <option value="Probation">Probation</option>
            </select>
            @error('status_karyawanchoice')
               <div class="alert alert-danger mt-2">
                     {{ $message }}
               </div>
            @enderror
   </div>

   <div class="form-group col-md-6" id="inputForm1" style="display: none;">
      <label class="mr-sm-2" for="inputForm1">Sign date* </label>
      <input type="text" class="form-control datepicker" name="signdate" id="signdate">
            @error('signdate')
               <div class="alert alert-danger mt-2">
                     {{ $message }}
               </div>
            @enderror
   </div> 
   <div class="form-group col-md-6" id="inputForm2"  style="display: none;">
      <label class="mr-sm-2" for="inputForm2">End employment status date* </label>
      <input type="text" class="form-control datepicker" name="untildate" id="untildate">
            @error('untildate')
               <div class="alert alert-danger mt-2">
                     {{ $message }}
               </div>
            @enderror
   </div> 



   <div class="form-group col-md-6">
      <label class="mr-sm-2" for="fk_nama_perusahaan">Perusahaan*</label>
      <select class="form-control form-control-sm col-form-input @error('fk_nama_perusahaan') is-invalid @enderror" id="fk_nama_perusahaan" name="fk_nama_perusahaan">
         <option value="" selected disabled>---Pilih---</option>
         @foreach ($pt as $pts)
            <option value="{{ $pts->id }}">{{ $pts->nama }}</option>
         @endforeach
      </select>
      @error('fk_nama_perusahaan')
         <div class="alert alert-danger mt-2">
               {{ $message }}
         </div>
      @enderror
   </div>
<!--

      <div class="mb-3">
         <label for="fk_cabang" class="form-label">Cabang</label>
         <select class="form-control" name="fk_cabang" id="fk_cabang"></select>
      </div>
-->
   <div class="form-group col-md-6">
      <label class="mr-sm-2" for="fk_cabang">Cabang*</label>
     <select class="form-control" name="fk_cabang" id="fk_cabang"></select>

   </div>
 


   <div class="form-group col-md-6">
      <label class="mr-sm-2" for="fk_bagian">Bagian*</label>
      <select class="form-control form-control-sm col-form-input @error('fk_bagian') is-invalid @enderror" id="fk_bagian" name="fk_bagian">
               <option value="" selected disabled>---Pilih---</option>
               @foreach ($bagian as $pts)
                  <option value="{{ $pts->id }}">{{ $pts->nama }}</option>
               @endforeach
            </select>

            @error('fk_bagian')
               <div class="alert alert-danger mt-2">
                     {{ $message }}
               </div>
            @enderror
   </div>


   <div class="form-group col-md-6">
      <label class="mr-sm-2" for="fk_level_jabatan">Level Jabatan*</label>
      <select class="form-control form-control-sm col-form-input @error('fk_level_jabatan') is-invalid @enderror" id="fk_level_jabatan" name="fk_level_jabatan">
               <option value="" selected disabled>---Pilih---</option>
               @foreach ($jabatan as $pts)
                  <option value="{{ $pts->id }}">{{ $pts->nama }}</option>
               @endforeach
            </select>
            @error('fk_level_jabatan')
               <div class="alert alert-danger mt-2">
                     {{ $message }}
               </div>
            @enderror
   </div>



   <div class="form-group col-md-12">
      <label class="mr-sm-2" for="fk_level_jabatan">Keterangan*</label>
      <textarea name="keterangan" id="keterangan" cols="0" rows="5" style="height: 100px; width: 500px;"></textarea>
         <!-- error message untuk title -->
         @error('keterangan')
            <div class="alert alert-danger mt-2">
                  {{ $message }}
            </div>
         @enderror
   </div>
<!-- tesss -->

<!-- akhir -->
</div>
      
   

   <div class="modal-footer">
      <button type="button" class="btn btn-secondary" onclick="Close()" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" onclick="storetransferonclick()">Simpan</button>
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

<script>
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

<script>
// Get references to the select element and the input fields
const selectChoicetrans = document.getElementById('status_karyawanchoice');
const fieldName = document.getElementById('inputForm1');
const fieldAddress = document.getElementById('inputForm2');
const signdaterequired = document.getElementById('signdate'); 
const untildaterequired = document.getElementById('untildate'); 

// Add an event listener to the select element
selectChoicetrans.addEventListener('change', function() {
// Check the selected value of the select element
const selectedValuetrans = selectChoicetrans.value;
  // alert(selectedValue);
  // Show or hide the input fields based on the selected value
  if (selectedValuetrans === 'Permanent') {
    fieldName.style.display = 'block'; // Show the name input field 
    fieldAddress.style.display = 'none'; // Hide the address input field
    fieldAddress.value = '';
    signdaterequired.setAttribute('required', 'required');
    untildaterequired.removeAttribute('required');
  } else {
    fieldName.style.display = 'none'; // Hide the name input field
    fieldAddress.style.display = 'block'; // Show the address input field
    fieldAddress.value = '';
    untildaterequired.setAttribute('required', 'required');
    signdaterequired.removeAttribute('required');
  }
});
</script>

<script>
$(document).ready(function() {
$('#fk_nama_perusahaan').on('change', function() {
   var ptid = $(this).val();
   if(ptid) {
         $.ajax({
            url: '/trans/getquerycabang/'+ptid,
            type: "GET",
            data : {"_token":"{{ csrf_token() }}"},
            dataType: "json",
            success:function(data)
            {
            if(data){
                  $('#fk_cabang').empty();
                  $('#fk_cabang').append('<option hidden>Choose Cabang</option>'); 
                  $.each(data, function(key, value){
                     $('select[name="fk_cabang"]').append('<option value="'+ value.id +'">' + value.nama + '</option>');
                  });
            }else{
                  $('#fk_cabang').empty();
            }
         }
         });
   }else{
      $('#fk_cabang').empty();
   }
});
});
</script>