<div class="mb-3 row row-body">
   <table class="table">
  <tbody>
    <tr>
      <th scope="row">Nama Karyawan</th>
      <td>:</td>
      <td>{{$data->karyawan->nama_lengkap}}</td>
    </tr>
    <tr>
    <th scope="row">Nik</th>
      <td>:</td>
      <td>{{$data->karyawan->nomor_induk_karyawan}}</td>
    </tr>
    <tr>
    <th scope="row">Jabatan</th>
      <td>:</td>
      <td>{{$data->karyawan->jabatan->nama}}</td>
    </tr>
  </tbody>
</table>
   </div>
   <form id="myform" enctype="multipart/form-data">
   <!-- input transfer -->
   <div class="form-row mb-2">
      <label for="sangsi">Approve</label>
      <select class="form-control select2  form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" id="approve" name="approve">
               <option value="Approve">Approve</option>              
            </select>
    </div>
    
  <div class="form-row">
    <!-- <div class="form-group col-md-6">
      <label for="inputCity">Berlaku</label>
      <input type="date" name="startdate"  class="form-control"></input>
    </div>
    <div class="form-group col-md-6">
      <label for="inputState">Hingga</label>
      <input type="date" name="enddate"  class="form-control"></input>     
    </div> -->
    <input type="text"  name="idperingatan"  class="form-control select2-hidden-accessible"  value ="{{$data->id}}">
    <div class="form-group col-md-6">
      <label for="sangsi">Sangsi</label>
      <select class="selectize" style="width: 100%;" tabindex="-1" aria-hidden="true" id="sangsi" name="sangsi">
               <option value="{{$data->jenis_peringatan}}" selected>{{$data->jenis_peringatan}}</option>
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
      <select class="selectize @error('pasal') is-invalid @enderror" id="pasal" name="pasal"  onChange="cekpasal()">
               <option value="" selected disabled>---Pilih---</option>
               @foreach ($pasal as $ps)
               <option value="{{ $ps->id }}" {{ $ps->id == $data->pasal->id  ? 'selected' :''}}>Pasal {{ $ps->pasal }}- Ayat {{ $ps->ayat }}</option>
               @endforeach
            </select>
            @error('pasal')
               <div class="alert alert-danger mt-2">
                     {{ $message }}
               </div>
            @enderror
         </div>
    </div>
    <div class="form-group col-md-12">
      <label for="isipasal">Isi Pasal</label>
      <textarea id="datapasal" class="form-control" readonly>{{$data->pasal->isiayat}}</textarea> 
    </div>
    <div class="form-group col-md-12">
      <label for="keterangan">Keterangan</label>
      <textarea name="keterangan" id="keterangan" class="form-control" >{{$data->note}}</textarea>
         <!-- error message untuk title -->
         @error('keterangan')
            <div class="alert alert-danger mt-2">
                  {{ $message }}
            </div>
         @enderror
      </div>
      @foreach ($wtch as $item)

      @endforeach
      <div class="form-group col-md-12">
        <label for="pasal">Watcher</label>
        <select class="selectize" id="watcher" data-placeholder="Choose" name="watcher[]"  multiple>
          @foreach ($employes as $ps)
              <option value="{{ $ps->id }}" {{ in_array($ps->id, $wtch->toArray()) ? 'selected' : '' }} >{{ $ps->nomor_induk_karyawan }} - {{ $ps->nama_lengkap }}</option>
            </option>
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
   <div class="modal-footer">
      <button type="button" class="btn btn-secondary" onclick="Close()" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" onclick="storeapprovesp()">Approve</button>
   </div>
</form>


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