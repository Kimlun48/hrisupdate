<!-- Modal Reject -->
<div class="modal fade bd-example-modal-lg" id="exampleModalReject{{$det->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel">Reject Process {{$det->progres}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
       <form action="{{ route('verif.storereject') }}" method="POST">
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
	<button type="submit" class="btn btn-primary" onclick="$('#cover-spin').show(0)">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Reject-->


