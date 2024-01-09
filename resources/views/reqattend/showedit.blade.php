<div class="p2">
<form class="form-horizontal" id="approveform" enctype="multipart/form-data">
    <div class="form-group">
        <input type="text" id="nama" name="nama" class="form-control" value="{{ $data->karyawan->nama_lengkap}}" readonly> 
    </div>
    
    <div class="form-group">
        <input type="text" id="tanggal" name="tanggal" class="form-control" value="{{ $data->tanggal}}" readonly> 
    </div>
    
    <div class="form-group">
      <select name="stsapp" id="stsapp" class="form-control">
	<option value="approve">Approve</option>
        <!-- <option value="reject">Reject</option> -->
     </select>
    </div>
    
    <div class="form-group">
        <input type="hidden" id="id_karyawan" name="id_karyawan" class="form-control" value="{{ $data->id}}"> 
    </div>

    <div class="form-group">
        <button class="btn btn-success" onClick="approve({{$data->id}})">Approve</button>
    </div>
</form>
</div>

<!-- <script>
    ClassicEditor
    .create( document.querySelector( '#notes' ) )
    .catch( error => {
        console.log( error );
    } );
</script> -->
