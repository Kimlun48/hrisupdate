<div class="p2">
   <form id="myform" enctype="multipart/form-data">
      @csrf
      
      <!-- input transfer -->
   
   <div class="form-row align-items-center">
      <div class="form-group col-md-12">
         <label class="mr-sm-2" for="inlineFormCustomSelect">Employee</label>
         <select id="mySelect" multiple id="karyawan" name="karyawan[]" custom-select mr-sm-2>
            @foreach ($kr as $krs)
              <option value="{{ $krs->id }}">{{ $krs->nama_lengkap }}<!---{{ $krs->nomor_induk_karyawan }}--></option>
            @endforeach
         </select>
            @error('karyawan')
               <div class="alert alert-danger mt-2">
                  {{ $message }}
               </div>
            @enderror
      </div>
   
      <div class="form-group col-md-12">
         <label class="mr-sm-2" for="tgl_transfer">Effective date* </label>
         <input type="date" name="tgl_transfer" class="ms-1 form-control form-control-sm col-form-input">
            @error('tgl_transfer')
               <div class="alert alert-danger mt-2">
                  {{ $message }}
               </div>
            @enderror
      </div>
   
   
      <div class="form-group col-md-12">
         <label class="mr-sm-2" for="type">Transfer Type*</label>
         <select class="selectize @error('type') is-invalid @enderror" id="type" name="type">
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
         <label class="mr-sm-2" for="status_karyawan">Employment status </label>
         <select class="form-control form-control-sm col-form-input @error('status_karyawan') is-invalid @enderror" id="status_karyawan" name="status_karyawan">            
                  <option value="" selected disabled>---Pilih---</option>
                  <option value="Permanent">Permanent</option>
                  <option value="Contract">Contract</option>
                  <option value="Probation">Probation</option>
                  <option value="PHL">PHL</option>
               </select>
               @error('status_karyawan')
                  <div class="alert alert-danger mt-2">
                        {{ $message }}
                  </div>
               @enderror
      </div>
   
      <div class="form-group col-md-6" id="inputForm1"  style="display: none;">
         <label class="mr-sm-2" for="status_karyawan">Sign date* </label>
         <input type="date" class="form-control" name="signdate">
               @error('signdate')
                  <div class="alert alert-danger mt-2">
                        {{ $message }}
                  </div>
               @enderror
      </div> 
      <div class="form-group col-md-6" id="inputForm2"  style="display: none;">
         <label class="mr-sm-2" for="status_karyawan">End employment status date* </label>
         <input type="date" class="form-control" name="untildate">
               @error('status_karyawan')
                  <div class="alert alert-danger mt-2">
                        {{ $message }}
                  </div>
               @enderror
      </div> 
   
   
   
      <div class="form-group col-md-6">
         <label class="mr-sm-2" for="fk_nama_perusahaan">Perusahan*</label>
         <select class="selectize @error('fk_nama_perusahaan') is-invalid @enderror" id="fk_nama_perusahaan" name="fk_nama_perusahaan">
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
         <select class="selectize @error('fk_cabang') is-invalid @enderror" id="fk_cabang" name="fk_cabang">
                  <option value="" selected disabled>---Pilih---</option>
                  @foreach ($cabs as $pts)
                     <option value="{{ $pts->id }}">{{ $pts->nama }}</option>
                  @endforeach
               </select>
   
               @error('fk_cabang')
                  <div class="alert alert-danger mt-2">
                        {{ $message }}
                  </div>
               @enderror
      </div>
   
   
   
      <div class="form-group col-md-6">
         <label class="mr-sm-2" for="fk_bagian">Bagian*</label>
         <select class="selectize @error('fk_bagian') is-invalid @enderror" id="fk_bagian" name="fk_bagian">
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
         <select class="selectize @error('fk_level_jabatan') is-invalid @enderror" id="fk_level_jabatan" name="fk_level_jabatan">
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
         
      <div class="mb-3 row row-body">
         <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10" style="width: 200px;">
            <input type="hidden" readonly id="id" name="id_karyawan" class="ms-1 form-control form-control-sm col-form-input" value=""
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
   
   <script>
      const select = new Choices('#mySelect', { removeItemButton: true });
      const selectedValues = select.getValue();
   </script>
   
   
   
   <script>
      $('.selectize').each(function () {
        var placeholder = $(this).data('placeholder');
        var multiple = $(this).prop('multiple'); // Check if the select should allow multiple selections
          $(this).selectize({
              // plugins: ["remove_button", "clear_button"],
              delimiter: ',',
              persist: false,
              create: false,
              placeholder: placeholder,
              multiple: multiple, // Set the 'multiple' option based on the attribute of the select element
          });
      });
  
  </script>
   
   
   
   <script>
   // Get references to the select element and the input fields
   const selectChoice = document.getElementById('status_karyawan');
   const fieldName = document.getElementById('inputForm1');
   const fieldAddress = document.getElementById('inputForm2');
   
   // Add an event listener to the select element
   selectChoice.addEventListener('change', function() {
     // Check the selected value of the select element
     const selectedValue = selectChoice.value;
   
     // Show or hide the input fields based on the selected value
     if (selectedValue === 'Permanent') {
       fieldName.style.display = 'block'; // Show the name input field
       fieldAddress.style.display = 'none'; // Hide the address input field
       fieldAddress.value = '';
     } else {
       fieldName.style.display = 'none'; // Hide the name input field
       fieldAddress.style.display = 'block'; // Show the address input field
       fieldAddress.value = '';
     }
   });
   </script>