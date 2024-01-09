<div class="p2">
<form class="form-horizontal" id="approvechangeshift" enctype="multipart/form-data">


    <div class="form-group">
        <input type="text" id="stsapp" name="stsapp" class="form-control" value="Approve" readonly> 
    </div>

    <div class="form-group">
        <input type="hidden" id="id_karyawan" name="id_karyawan" class="form-control" value="{{ $data->id }}"> 
    </div>

    <div class="form-group">
        <label for="notes">Reason</label>
        <textarea type="text" id="notes" name="notes" class="form-control" > </textarea>
    </div>

    <div class="form-group">
        <button class="btn btn-success" onClick="approvechangeshift({{$data->id}})">Approve</button>
    </div>
</form>
</div>
