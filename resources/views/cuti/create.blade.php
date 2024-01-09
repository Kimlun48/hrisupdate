<div class="modal-body">
        <form id='createForm'>
                  @csrf         
          <div class="form-group">
              <a href="/cuti/cutiformatexcel" class="btn btn-warning mb-4 center" data-toggle="tooltip" data-placement="top" title="Format Data External" >Format Data : Cuti Bulk</a>
          </div>                  
          <div class="form-group">
            <label for="filecutibulk">Upload Data</label>
            <input type="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" class="form-control form-control-sm col-form-input" name="filecutibulk">
          </div>
        </form>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" onclick="Close()" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="createparam()">Save</button>
      </div>

