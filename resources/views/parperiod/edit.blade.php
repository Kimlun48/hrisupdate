<div class="modal-body">
        <form id="editForm">
          <div class="form-group">
              <label for="startdate">Start Date</label>
              <!-- <input type="number" class="form-control" value="{{$param->startdate}}" id="startdate" name="startdate"> -->
              <select  class="form-control" id="startdate" name="startdate">
              @foreach ($list as $value => $label)
                <option value="{{ $label }}" {{ $param->startdate == $label  ? 'selected' :''}}>{{ $label }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
              <label for="enddate">End Date</label>
              <!-- <input type="number" class="form-control" value="{{$param->enddate}}" id="enddate" name="enddate"> -->
              <select  class="form-control" id="enddate" name="enddate">
              @foreach ($list as $value => $label)
                <option value="{{ $label }}" {{ $param->enddate == $label  ? 'selected' :''}}>{{ $label }}</option>
              @endforeach
            </select>

          </div>
          <div class="form-group">
              <label for="enddate">End Date</label>
              <select class="form-control form-control-sm col-form-input  @error('status') is-invalid @enderror" id="status" name="status" required>
                <option value="">--Please Select--</option>
                <option value="Aktif">Aktif</option>
                <option value="NonAktif">NonAktif</option>
                </select>
                @error('status')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
          </div>
        </form>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" onclick="Close()" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning" onclick="storeedit({{$param->id}})">Save</button>
      </div>
