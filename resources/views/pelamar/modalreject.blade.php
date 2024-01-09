    <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel">Reject Process {{$det->progres}}</h5>
        <button type="button" class="close" onclick="closeReject()" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form id="myformReject">
        @csrf
        <div class="mb-3 row row-body">
            <input type = "hidden"  id="cekidreject" name="cekidreject" value="{{$det->id}}" >
            <label class="col-sm-2 col-form-label">Note <span class="text-danger">*</span></label>
            <div class="col-sm-10">
                <textarea class="form-control col-form-input  @error('notereject') is-invalid @enderror" id="notereject" name="notereject" rows="5"
                placeholder="Add note" value="{{ old('notereject') }}"></textarea>
                @error('notereject')
                <div class="alert alert-danger mt-2">
                {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeReject()">Cancel</button>
        <button type="submit" class="btn btn-primary" id="storeReject">Submit</button>
        </form>
    </div>
    </div>
