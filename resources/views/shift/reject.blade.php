<div class="p2">
<form class="form-horizontal" id="rejectchangeshift" enctype="multipart/form-data">

    <div class="form-group">
        <input type="text" id="stsapp" name="stsapp" class="form-control" value="Reject" readonly> 
    </div>

    <div class="form-group">
        <input type="hidden" id="id_karyawan" name="id_karyawan" class="form-control" value="{{ $data->id}}"> 
    </div>

    <div class="form-group">
        <label for="keterangan">Reason</label>
        <textarea type="text" id="notes" name="notes" class="form-control" > </textarea>
    </div>

    <div class="form-group">
        <button class="btn btn-success" onClick="rejectchangeshift({{$data->id}})">Reject</button>
    </div>
</form>
</div>
