<!-- Start Modals Approve -->
<div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Position Job Create</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('posisijob.store') }}" method="POST" enctype="multipart/form-data">
          <div class="container container-create-verif">
            <div class="row row-create">
              <div class="col col-create">
                <div class="card card-create">
		              <div class="card-body" name="bookId" id="bookId">
                    @csrf
                    <div class="form-group">
                      <input type="text" class="form-control form-control-sm @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" placeholder="Enter Position">
                      @error('nama')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
	            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-sm btn-primary" onclick="$('#cover-spin').show(0)">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End Modals Approve -->



