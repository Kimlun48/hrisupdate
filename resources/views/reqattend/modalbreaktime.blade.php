<div class="p2">
   <form class="form-horizontal" id="myform" enctype="multipart/form-data">
       <div class="form-group">
           <input type="text" id="nama" name="nama" class="form-control" value="{{ $data->nama_lengkap}}" readonly> 
       </div>
       
       <div class="form-group">
           <select name="jenis" id="jenis" class="form-control">
            <option value="Out">Out</option>
            <option value="In">In</option>
        </select>
       </div>
       
       <div class="form-group">
           <input type="hidden" id="id_karyawan" name="id_karyawan" class="form-control" value="{{ $data->id}}"> 
       </div>
       
       <div class="form-group">
           <button class="btn btn-primary" onClick="breaktimee()">Request</button>
       </div>
   </form>
</div>
