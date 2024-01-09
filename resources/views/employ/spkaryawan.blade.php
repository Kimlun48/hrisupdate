<div class="p2">
   <form id="myform" enctype="multipart/form-data">
      @csrf
   
      <!-- old value -->
      <div class="mb-3 row row-body">
      <table class="table">
     <tbody>
       <tr>
         <th scope="row">Nama Karyawan</th>
         <td>:</td>
         <td>{{$data->nama_lengkap}}</td>
       </tr>
       <tr>
       <th scope="row">Nik</th>
         <td>:</td>
         <td>{{$data->nomor_induk_karyawan}}</td>
       </tr>
       <tr>
       <th scope="row">Jabatan</th>
         <td>:</td>
         <td>{{$data->jabatan->nama}}</td>
       </tr>
     </tbody>
   </table>
      </div>
      
      <!-- input transfer -->
      
     <div class="form-row">
       <input type="text" hidden  name="id_kar"  class="form-control"  value="{{$data->id}}"></input>

         <div class="form-group col-md-6">
            <label for="sangsi">Sangsi</label>
            <select class="selectize" style="width: 100%;" tabindex="-1" aria-hidden="true" id="sangsi" name="sangsi" data-placeholder="Choose sangsi">
               <option value="" disable>Choose Sangsi</option>
               <option value="sp1">SP 1</option>
               <option value="sp2">SP 2</option>
               <option value="sp3">Sp 3</option>
               <option value="teguran1">Teguran 1</option>
               <option value="teguran2">Teguran 2</option>
               <option value="teguran3">Teguran 3</option>
               <option value="skorsing">Skorsing</option>
            </select>
         </div>

         <div class="form-group col-md-6">
            <label for="pasal">Pasal</label>
            <select class="selectize" id="pasal" name="pasal"  onChange="cekpasal()" data-placeholder="Choose pasal">
               <option value="" selected disabled>---Pilih---</option>
               @foreach ($pasal as $ps)
                  <option value="{{ $ps->id }}">Pasal {{ $ps->pasal }}- Ayat {{ $ps->ayat }}</option>
               @endforeach
            </select>
            @error('pasal')
               <div class="alert alert-danger mt-2">
                     {{ $message }}
               </div>
            @enderror
         </div>
        
       <div class="form-group col-md-12">
         <label for="isipasal">Isi Pasal</label>
         <textarea id="datapasal" class="form-control" readonly></textarea> 
       </div>
       <div class="form-group col-md-12">
         <label for="keterangan">Keterangan</label>
         <textarea name="keterangan" id="keterangan" class="form-control" ></textarea>
            <!-- error message untuk title -->
            @error('keterangan')
               <div class="alert alert-danger mt-2">
                     {{ $message }}
               </div>
            @enderror
         </div>

         <div class="form-group col-md-12">
            <label for="pasal">Watcher</label>
            <select class="selectize" id="watcher" name="watcher[]"  multiple>
               <option value="" selected disabled>---Pilih---</option>
               @foreach ($employes as $ps)
                  <option value="{{ $ps->id }}">{{ $ps->nomor_induk_karyawan }} - {{ $ps->nama_lengkap }}</option>
               @endforeach
            </select>
            @error('watcher')
               <div class="alert alert-danger mt-2">
                     {{ $message }}
               </div>
            @enderror
         </div>
       </div>
      </div>
       </div>
     </div>
   
     
   
     
   
     
      <div class="modal-footer">
         <button type="button" class="btn btn-secondary" onclick="Close()" data-dismiss="modal">Close</button>
         <button type="button" class="btn btn-primary" onclick="storesp()">Simpan</button>
      </div>
   
   </form>
   </div> 
   


<script>
    // Initialize Selectize elements
    $('.selectize').each(function () {
        var placeholder = $(this).data('placeholder');
        var multiple = $(this).prop('multiple'); // Check if the select should allow multiple selections
        $(this).selectize({
            plugins: ["remove_button", "clear_button"],
            delimiter: ',',
            persist: false,
            create: false,
            placeholder: placeholder,
            multiple: multiple, // Set the 'multiple' option based on the attribute of the select element
        });
    });
</script>