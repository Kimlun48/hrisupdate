<div class="modal-body">
        <form id="createForm">
          <div class="form-group">
              <label for="startdate">Start Date</label>
              <select  class="form-control" id="startdate" name="startdate">
              @foreach ($list as $value => $label)
                <option value="{{ $value }}">{{ $label }}</option>
              @endforeach
            </select>
              <!-- <input type="number" class="form-control" id="startdate" name="startdate"> -->
          </div>
          <div class="form-group">
              <label for="enddate">End Date</label>
              <select  class="form-control" id="enddate" name="enddate">
              @foreach ($list as $value => $label)
                <option value="{{ $value }}">{{ $label }}</option>
              @endforeach
            </select>
              <!-- <input type="number" class="form-control" id="enddate" name="enddate"> -->
          </div>
        </form>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" onclick="Close()" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning" onclick="createparam()">Save</button>
      </div>
