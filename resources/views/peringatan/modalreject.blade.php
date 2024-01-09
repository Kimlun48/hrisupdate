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
      <label for="sangsi">Reject</label>
      <select class="form-control select2 select2-hidden-accessible form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" id="reject" name="reject">
               <option value="Reject">Reject</option>              
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
    <input type="text"  name="idperingatan"  class="form-control"  value ="{{$data->id}}"></input>
    <div class="form-group col-md-6">
      <label for="sangsi">Sangsi</label>
      <select class="form-control select2 select2-hidden-accessible form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" id="sangsi" name="sangsi" readonly>
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
      <select class="form-control select2 select2-hidden-accessible form-control @error('pasal') is-invalid @enderror" id="pasal" name="pasal"  onChange="cekpasal()">
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
   </div>
    </div>
  </div>
   <div class="modal-footer">
      <button type="button" class="btn btn-secondary" onclick="Close()" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-danger" onclick="storerejectsp()">Reject</button>
   </div>
</form>




<!-- selectize -->
<link defer rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js" integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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