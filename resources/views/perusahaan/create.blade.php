
@extends('layouts.app-master')

@section('content-employ')
    <div class="create-branch">
        <div class="head">
            <h5 class="title-creabranchte">Add Company Ads</h5>
        </div>
        <div class="container">
            @auth
            <form action="{{ route('perusahaan.store') }}" method="POST" enctype="multipart/form-data">
                <div class="container container-branch">
                    <div class="row row-branch">
                        <div class="col col-branch">
                        <h5 class="card-title">Company Detail</h5>
                            <div class="card card-branch">
                                <div class="card-body">
                                @csrf
                                    <div class="mb-3 row row-body">
                                        <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Name <span class="wajib">*</span></label>
                                        <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                        <input type="text" class="form-control form-control-sm col-form-input @error('nama') is-invalid @enderror" name="nama"
                                            value="{{ old('nama') }}" placeholder="Enter Company Name">
                                    
                                        <!-- error message untuk title -->
                                        @error('nama')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        
                                        </div>
                                    </div>
                                    <div class="mb-3 row row-body">
                                        <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Code <span class="wajib">*</span></label>
                                        <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                        <input type="text" class="form-control form-control-sm col-form-input @error('kode') is-invalid @enderror" name="kode"
                                            value="{{ old('kode') }}" placeholder="Enter Company Code">
                                    
                                        <!-- error message untuk title -->
                                        @error('kode')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        
                                        </div>
                                    </div>              
                                    <div class="mb-3 row row-body">
                                        <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Logo <span class="wajib">*</span></label>
                                        <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                        <input type="file" accept="image/*" class="form-control form-control-sm col-form-input @error('logo') is-invalid @enderror" name="logo" >
                                            <!-- error message untuk title -->
                                            @error('logo')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
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
                    </div>       
                </div>
            </form>
        </div>
    </div>



    <script>
        //message with toastr
        @if(session()->has('success'))
        
            toastr.success('{{ session('success') }}', 'BERHASIL!'); 

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!'); 
            
        @endif
    </script> 

        @endauth

   
@endsection

