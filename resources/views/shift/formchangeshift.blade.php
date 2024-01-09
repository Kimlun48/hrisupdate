<div class="p2">
<form id="myform" enctype="multipart/form-data">
   @csrf

   <div class="form-row row-body">
    <div class="form-group col-md-6">
      <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">When</label>
      <input type="date" class="ms-1 form-control form-control-sm col-form-input"  onkeydown='event.preventDefault()'  name="startdate"
         value="{{ old('startdate') }}">
      <!-- error message untuk title -->
      @error('startdate')
         <div class="alert alert-danger mt-2">
               {{ $message }}
         </div>
      @enderror
    </div>

    <div class="form-group col-md-6">
    <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Shift</label>
         <div class="form-group">
            <select name="shift_awal" id="shift_awal" class="ms-1 form-control form-control-sm col-form-input @error('shift_awal') is-invalid @enderror"
               value="{{ old('shift_awal') }}">
               @foreach ($par as $param)
                  <option value="{{ $param->id }}">{{ $param->jenis_shift }}</option>
               @endforeach
            </select>
         </div>
      <!-- error message untuk title -->
      @error('statusoff')
         <div class="alert alert-danger mt-2">
               {{ $message }}
         </div>
      @enderror
    </div>
  </div>

  <div class="form-row row-body">
    <div class="form-group col-md-6">
      <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">To</label>
      <input type="date" class="ms-1 form-control form-control-sm col-form-input"  onkeydown='event.preventDefault()'  name="enddate"
         value="{{ old('enddate') }}">
      <!-- error message untuk title -->
      @error('enddate')
         <div class="alert alert-danger mt-2">
               {{ $message }}
         </div>
      @enderror
    </div>

    <div class="form-group col-md-6">
    <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Shift</label>
      <div class="form-group">
         <select name="shift_akhir" id="shift_akhir" class="ms-1 form-control form-control-sm col-form-input @error('shift_akhir') is-invalid @enderror"
            value="{{ old('shift_akhir') }}">
            @foreach ($par as $param)
               <option value="{{ $param->id }}">{{ $param->jenis_shift }}</option>
            @endforeach
         </select>
      </div>
      <!-- error message untuk title -->
      @error('statusoff')
         <div class="alert alert-danger mt-2">
               {{ $message }}
         </div>
      @enderror
   </div>

   <div class="form-row row-body">
    <div class="form-group col-md-6">
      <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Off</label>
      <span class="badge badge-primary mb-2">Di isi jika off sebelumnya terganti oleh shift</span>
      <input type="date" id="dt3" class="ms-1 form-control form-control-sm col-form-input"  onkeydown='event.preventDefault()'  name="tgl_off"
         value="{{ old('tgl_off') }}">
      <!-- error message untuk title -->
      @error('tgl_off')
         <div class="alert alert-danger mt-2">
               {{ $message }}
         </div>
      @enderror
    </div>

   <div class="form-row row-body">
    <div class="form-group col-md-12">
      <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Reason</label>
      <textarea name="keterangan" class="ms-1 form-control form-control-sm col-form-input"></textarea>
      <!-- error message untuk title -->
      @error('keterangan')
         <div class="alert alert-danger mt-2">
               {{ $message }}
         </div>
      @enderror
    </div>

   

      <div class="mb-3 row row-body">
         <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
            <input type="hidden" id="id_karyawan" name="id_karyawan" class="ms-1 form-control form-control-sm col-form-input" value="{{ auth()->user()->getkaryawan->id}}"
            style="width: 360px;"> 
         </div>
      </div>


      <div class="modal-footer">
         <button type="button" class="btn btn-secondary" onclick="Close()" data-dismiss="modal">Close</button>
         <button type="button" class="btn btn-primary" onclick="store()">Request</button>
      </div>

   </form>
</div>


  


 
