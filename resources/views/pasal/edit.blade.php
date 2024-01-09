      <div class="modal-body">
        <form id="editForm">
          <input type="hidden" id="id" name="id">
          <div class="form-group"> 
            <label for="status" >Status</label>
            <select class="form-control" id="status" name="status">{{$pas->status}}
              <option value="aktif">Aktif</option>
              <option value="nonaktif">Non-Aktif</option>
            </select>
          </div>
          <div class="form-group">
            <label for="pasal">Chapter</label>
            <input type="text" value="{{$pas->pasal}}" class="form-control" id="pasal" name="pasal">
          </div>
          <div class="form-group">
            <label for="ayat">Paragraph</label>
            <input type="text" value="{{$pas->ayat}}" class="form-control" id="ayat" name="ayat">
          </div>
          <!-- <div class="form-group">
              <label for="isiayat">Isi Ayat</label>
              <textarea style="height: 150px;" class="form-control" id="isiayat" name="isiayat">{{$pas->isiayat}}</textarea>
          </div> -->

          <div class="form-group">
            <label for="isiayat">Fill</label>
            <textarea style="resize: vertical; height: 400px; width: 100%;" class="form-control" id="isiayat" name="isiayat">{{$pas->isiayat}}</textarea>
          </div>
          <input type="hidden" value="{{$pas->id}}" class="form-control" id="id" name="id">
        </form>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-light" onclick="Close()" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="storeedit()">Save</button>
      </div>


