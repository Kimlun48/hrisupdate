    <div class="modal fade detail-pelamar" id="createannoun" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-pelamar" role="document">
          <div class="modal-content modal-content-pelamar">
            <div class="modal-body modal-body-pelamar">
               


    <div class="create-announcement">
        <div class="container">
        
        <form action="{{ route('announcement.store') }}" method="POST" enctype="multipart/form-data">
        <div class="container container-announcement">
            <div class="row row-announcement">
                <div class="col col-announcement">
                <h5 class="card-title">Create Announcement</h5>
                    <div class="card card-announcement">
                        <div class="card-body">
                        @csrf
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Subject <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="text" class="form-control form-control-sm col-form-input @error('subject') is-invalid @enderror" name="subject"
                                    value="{{ old('subject') }}" placeholder="Add Subject">
                            
                                <!-- error message untuk title -->
                                @error('subject')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                 
                                </div>
                            </div>
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Content <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <textarea class="form-control col-form-input  @error('content') is-invalid @enderror" id="content" name="content" row="15"
                                     placeholder="Add Content" value="{{ old('content') }}"></textarea>
                                @error('content')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                 
                                </div>
                            </div>
                          
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Attachment</label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="file" accept="application/pdf" class="form-control form-control-sm col-form-input @error('attachment') is-invalid @enderror" name="attachment" >
                                    <!-- error message untuk title -->
                                    @error('attachment')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                          
                </div>
            </div>

           
            <div class="row justify-content-center row-btn">
                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-3 col-6 col-btn">
                <a href="{{url()->previous()}}" type="reset" class="btn btn-md btn-reset">Cancel</a>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-3 col-sm-3 col-6 col-btn">
                <button type="submit" class="btn btn-md btn-simpan">Save</button>
                </div>
            </div>

        
    </div>
    </div>
</form>
</div>

    <script>
        //message with toastr
        @if(session()->has('success'))
        
            toastr.success('{{ session('success') }}', 'BERHASIL!'); 

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!'); 
            
        @endif
    </script> 
<script>
    ClassicEditor
    .create( document.querySelector( '#content' ) )
    .catch( error => {
        console.log( error );
    } );
    //kalo Bikin image di dalam wywsiwig
    // ClassicEditor
    //     .create( document.querySelector( '#content' ), {
    //         ckfinder: {
    //             uploadUrl: '{{route('announcement.index').'?_token='.csrf_token()}}'
    //         }
    //     },{
    //         alignment: {
    //             options: [ 'right', 'right' ]
    //         }} )
    //     .then( editor => {
    //         console.log( editor );
    //     })
    //     .catch( error => {
    //         console.error( error );
    //     })

    
</script>


            </div>
      
          </div>
        </div>
      </div>
      


