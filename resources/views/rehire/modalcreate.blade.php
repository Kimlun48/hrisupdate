<div class="p2">
<form id="myform" enctype="multipart/form-data">
   @csrf
   
   <!-- input transfer -->

<div class="form-row align-items-center">
   <div class="form-group col-md-12">
      <label class="mr-sm-2">Name</label>
      <input type="hidden" name="idkar" value="{{$kr->id}}" class="ms-1 form-control form-control-sm col-form-input" readonly>
      <input type="text" name="nama" value="{{$kr->nama_lengkap}}" class="ms-1 form-control form-control-sm col-form-input" readonly>
         <!-- error message untuk title -->
         @error('nama')
            <div class="alert alert-danger mt-2">
                  {{ $message }}
            </div>
         @enderror
   </div>
   <div class="form-group col-md-12">
      <label class="mr-sm-2" for="tgl">Effective date* </label>
      <input type="text" name="tgl" class="ms-1 form-control form-control-sm col-form-input datepicker">
      <!-- <input type="date" name="tgl_transfer" class="ms-1 form-control form-control-sm col-form-input"> -->
         @error('tgl')
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

   <div class="form-group col-md-6">
      <label class="mr-sm-2" for="fk_cabang">Cabang*</label>
     <select class="form-control" name="fk_cabang" id="fk_cabang"></select>
   </div>
   

   <div class="form-group col-md-6">
      <label class="mr-sm-2" for="fk_bagian">Bagian*</label>
      <select class="form-control form-control-sm col-form-input @error('fk_bagian') is-invalid @enderror" id="fk_bagian" name="fk_bagian">
               <option value="" selected disabled>---Pilih---</option>
               @foreach ($bagian as $bags)
                   <option value="{{ $bags->id }}">{{ $bags->nama }}</option>
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
               @foreach ($jabs as $jab)
            <option value="{{ $jab->id }}">{{ $jab->nama }}</option>
         @endforeach
            </select>
            @error('fk_level_jabatan')
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

   <div class="form-group col-md-6">
      <label class="mr-sm-2" for="jns_karya">Employment status</label>
      <select class="form-control form-control-sm col-form-input @error('jenis_karyawan')
           is-invalid @enderror" id="jns_karya" name="jenis_karyawan">            
               <option value="" selected disabled>---Pilih---</option>
                @foreach($jnskar as $jns)
                <option value="{{$jns->id}}">{{$jns->nama}}</option>
                @endforeach
            </select>
            @error('jenis_karyawan')
               <div class="alert alert-danger mt-2">
                     {{ $message }}
               </div>
            @enderror
   </div>

   <div class="form-group col-md-12">
      <label class="mr-sm-2">Ketrangan</label>
      <textarea type="text" name="keterangan" class="ms-1 form-control form-control-sm col-form-input"></textarea>
         <!-- error message untuk title -->
         @error('nama')
            <div class="alert alert-danger mt-2">
                  {{ $message }}
            </div>
         @enderror
   </div>
</div>
      
   

   <div class="modal-footer">
      <button type="button" class="btn btn-secondary" onclick="Close()" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" onclick="storerehire()">Simpan</button>
   </div>

</form>
</div> 

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