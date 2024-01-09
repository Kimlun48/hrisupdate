@foreach($anns as $ann)

  <div class="modal fade detail-pelamar" id="exampleModalCenter2{{$ann->id}}" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-pelamar">
      <div class="modal-content modal-content-pelamar">
        <div class="modal-header modal-body-pelamar">
          <h5 class="modal-title title-pelamar" id="exampleModalCenterTitle">Detail Announcement</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body pelamar-content">

            <div class="mb-3 row row-body row-pelamar">
                <label class="col-lg-3 col-form-label">Subject</label>
                <div class="col-lg-1">:</div>
                <div class="col-lg-8 col-content">
                    <div class="text">{{ $ann->judul}}</div>
                </div>
            </div>   

            <div class="mb-3 row row-body row-pelamar">
                <label class="col-lg-3 col-form-label">Content</label>
                <div class="col-lg-1">:</div>
                <div class="col-lg-8 col-content">
                    <div class="text">{{ strip_tags($ann->isi) }}</div>
                </div>
            </div>  

            <div class="mb-3 row row-body row-pelamar">
                <label class="col-lg-3 col-form-label">Create by</label>
                <div class="col-lg-1">:</div>
                <div class="col-lg-8 col-content">
                    <div class="text">{{ $ann->getuser->name}}</div>
                </div>
            </div>  

            <div class="mb-3 row row-body row-pelamar">
                <label class="col-lg-3 col-form-label">Jabatan</label>
                <div class="col-lg-1">:</div>
                <div class="col-lg-8 col-content">
                    <div class="text">{{ $ann->getuser->getkaryawan->jabatan->nama}}</div>
                </div>
            </div>   

            <div class="file text-center">
                <label class="col-form-label">Attachment</label>
                <div class="file-border">{{ $ann->dokumen }}</div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@endforeach
