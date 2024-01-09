<div class="p2">
<form class="form-horizontal" id="approveform" enctype="multipart/form-data">
    <div class="form-group">
        <input type="text" id="nama" name="nama" class="form-control" value="{{ $data->getkar->nama_lengkap}}" readonly> 
    </div>
    
    <div class="form-group">
        <input type="text" id="tanggal" name="tanggal" class="form-control" value="{{ $data->tanggal}}" readonly> 
    </div>
    
    <div class="form-group">
      <select name="status_approve" id="status_approve" class="form-control">
	<!-- <option value="approve">Approve</option> -->
        <option value="reject">Reject</option>
     </select>
    </div>
    
    <div class="form-group">
        <input type="hidden" id="id_ovtime" name="id_ovtime" class="form-control" value="{{ $data->id}}"> 
    </div>

    <div class="form-group">
        <!-- <input type="hidden" id="id_karyawan" name="id_karyawan" class="form-control" value="{{ $data->id}}">  -->
        <input type="text" id="notes" name="notes" class="form-control" value="{{$data->note}}" readonly>
    </div> 

    <div class="form-group">
        <button class="btn btn-danger" onClick="approveovtime({{$data->id}})">Reject</button>
    </div>
</form>
</div>
