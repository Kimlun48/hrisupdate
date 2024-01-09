@extends('layouts.app-master')

@section('content')
<div class="create-verif">
<div class="container">
        @auth
        <h5 class="title-create">Process Applicant <hr class="garis-create"></h5>
        <h5 class="text-create-1">Mohon mengisi bagian yang ditandai (*) dengan lengkap.</h5>
        <h5 class="text-create-2">Please input your information for required field (*)</h5>
        <hr>
        <form action="{{ route('verif.store', $idtea) }}" method="POST">
        <div class="container container-create-verif">
            <div class="row row-create">
                <div class="col col-create">
                <h5 class="card-title">Process {{$list->progres}}</h5>
                    <div class="card card-create">
                        <div class="card-body">
                        @csrf
                            <div class="mb-3 row row-body">
                                <label class="col-sm-2 col-form-label">Status <span class="wajib">*</span></label>
                                <div class="col-sm-5">
                                <select class="form-control col-form-input  @error('status') is-invalid @enderror" id="status" name="status">
                                        <option value="Approved">Approved</option>
                                        <option value="Rejected">Rejected</option>
                                 </select>
                                 @error('status')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                            </div>


                            <!-- <div class="mb-3 row row-body">
                                <label class="col-sm-2 col-form-label">Progres <span class="wajib">*</span></label>
                                <div class="col-sm-5">
                                <input type="text" class="form-control col-form-input @error('progres') is-invalid @enderror" name="progres"
                                    value="{{ old('progres') }}" placeholder="Masukkan Note">
                            
                                
                                @error('progres')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                            </div> -->


                            <div class="mb-3 row row-body">
                                <label class="col-sm-2 col-form-label">Note <span class="wajib">*</span></label>

                                <div class="col-sm-10">
                                    <textarea class="form-control col-form-input  @error('note') is-invalid @enderror" id="note" name="note" rows="5"
                                     placeholder="Add note" value="{{ old('note') }}"></textarea>
                                    @error('note')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                            </div>

                         

                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center row-btn">
            <div class="col-lg-1 col-btn">
                <a href="{{ URL::previous() }}" class="btn btn-md btn-reset">Cancel</a>
                </div>
                <div class="col-lg-1 col-btn">
                <!-- <button type="reset" class="btn btn-md btn-reset">Cancel</button> -->
                <button type="submit" class="btn btn-md btn-simpan" onclick="$('#cover-spin').show(0)">Submit</button>
                </div>
                
            </div>
    </div>
    </div>
        @endauth
        <script>
    ClassicEditor
    .create( document.querySelector( '#note' ) )
    .catch( error => {
        console.log( error );
    } );

</script>

<div id="cover-spin"></div>

<style>
#cover-spin {
    position:fixed;
    width:100%;
    left:0;right:0;top:0;bottom:0;
    background-color: rgba(255,255,255,0.7);
    z-index:9999;
    display:none;
}

@-webkit-keyframes spin {
	from {-webkit-transform:rotate(0deg);}
	to {-webkit-transform:rotate(360deg);}
}

@keyframes spin {
	from {transform:rotate(0deg);}
	to {transform:rotate(360deg);}
}

#cover-spin::after {
    content:'';
    display:block;
    position:absolute;
    left:48%;top:40%;
    width:40px;height:40px;
    border-style:solid;
    border-color:black;
    border-top-color:transparent;
    border-width: 4px;
    border-radius:50%;
    -webkit-animation: spin .8s linear infinite;
    animation: spin .8s linear infinite;
}
</style>     
@endsection
