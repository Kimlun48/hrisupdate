<div class="modal-body">
        <form id="editForm">
          <input type="hidden" id="id" name="id"  value="{{$cuti->id}}" > 
          <div class="form-group">
            <label for="jumlah_cuti">Quota Cuti</label>
            <input type="number" step="1"  value="{{$cuti->jumlah_cuti}}" class="form-control" id="jumlah_cuti" name="jumlah_cuti">
          </div>
          <div class="form-group">
            <label for="sisa_cuti">Sisa Cuti</label>
            <input type="number" step="1"  value="{{$cuti->sisa_cuti}}" class="form-control" id="sisa_cuti" name="sisa_cuti">
          </div>
          
        </form>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" onclick="Close()" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning" onclick="storeedit()">Save</button>
      </div>


