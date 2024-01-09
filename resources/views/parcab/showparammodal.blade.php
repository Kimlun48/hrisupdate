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
      <label class="mr-sm-2" for="inlineFormCustomSelect">Cabang*</label>
      <select id="myCabang" multiple id="fk_cabang" name="cabang[]" custom-select mr-sm-2>
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



<!-- tesss -->

<!-- akhir -->
</div>

   <div class="modal-footer">
      <button type="button" class="btn btn-secondary" onclick="Close()" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" onclick="saveparam()">Simpan</button>
   </div>

</form>
</div> 

<script>
   const select = new Choices('#mySelect', { removeItemButton: true });
   const selectedValues = select.getValue();

</script>


<script>
   const select = new Choices('#myCabang', { removeItemButton: true });
   const selectedValues = select.getValue();

</script>




