<div class="modal-body">
        <form id="createForm">
          <input type="hidden" id="id" name="id">
          <div class="form-group">
            <label for="pasal">Chapter</label>
            <input type="text"  class="form-control" id="pasal" name="pasal">
          </div>
          <div class="form-group">
            <label for="ayat">Paragraph</label>
            <input type="text"  class="form-control" id="ayat" name="ayat">
          </div>
          <div class="form-group">
            <label for="isiayat">Fill</label>
            <textarea class="form-control" id="isiayat" name="isiayat" ></textarea>
          </div>
          
        

          <input type="hidden"  class="form-control" id="id" name="id">
        </form>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" onclick="Close()" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning" onclick="createpasal()">Save</button>
      </div>


