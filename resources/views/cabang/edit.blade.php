
@extends('layouts.app-master')

@section('content-employ')

    <div class="create-branch">
        <div class="container">
        @auth
        <h5 class="title-branch">Edit Branch <hr class="garis-branch"></h5>
        <h5 class="text-create-1">Mohon mengisi bagian yang ditandai (*) dengan lengkap.</h5>
        <h5 class="text-create-2">Please input your information for required field (*)</h5>
        <hr>
        <form action="/cabang/storeedit/{{ $cab->id }}/" method="POST" enctype="multipart/form-data">
        <div class="container container-branch">
            <div class="row row-branch">
                <div class="col col-branch">
                <h5 class="card-title">Branch Edit </h5>
                    <div class="card card-branch">
                        <div class="card-body">
                        @csrf
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Name <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="text" class="form-control form-control-sm col-form-input @error('nama') is-invalid @enderror" name="nama"
                                value="{{ $cab->nama}}" >   
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
                                 value="{{ $cab->kode}}">
                            
                                <!-- error message untuk title -->
                                @error('kode')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                 
                                </div>
                            </div>              
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Address <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="text" class="form-control form-control-sm col-form-input @error('alamat') is-invalid @enderror" name="alamat"
                                    value="{{ $cab->alamat }}">
                            
                                <!-- error message untuk title -->
                                @error('alamat')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                 
                                </div>
                            </div>                 
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Phone <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="number" class="form-control form-control-sm col-form-input @error('no_hp') is-invalid @enderror" name="no_hp"
                                     value="{{ $cab->no_hp }}">
                            
                                <!-- error message untuk title -->
                                @error('no_hp')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                 
                                </div>
                            </div>      

                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Other Phone <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="number" class="form-control form-control-sm col-form-input @error('no_telp') is-invalid @enderror" name="no_telp"
                                   value="{{ $cab->no_telp }}">
                            
                                <!-- error message untuk title -->
                                @error('no_telp')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                 
                                </div>
                            </div>                                      
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Parent <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <select class="form-control form-control-sm col-form-input" id="fk_nama_perusahaan" name="fk_nama_perusahaan">
                                   @foreach ($pts as $pt)
                                     <option value="{{ $pt->id }}" {{ $pt->id == $cab->perusahaan->id  ? 'selected' :''}}>{{ $pt->nama }}</option>
                                   @endforeach
                                 </select>
                                </div>
                            </div> 

                             <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Latitude <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="text" class="form-control form-control-sm col-form-input @error('latitude') is-invalid @enderror" name="latitude" value="{{ $cab->latitude }}">
                            
                                <!-- error message untuk title -->
                                @error('latitude')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                 
                                </div>
                            </div>                 
                            
                              <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Longitude <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="text" class="form-control form-control-sm col-form-input @error('longitude') is-invalid @enderror" name="longitude" value="{{ $cab->longitude }}">
                            
                                <!-- error message untuk title -->
                                @error('longitude')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                 
                                </div>
                            </div>                 
                              <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Radius <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="number" class="form-control form-control-sm col-form-input @error('radius') is-invalid @enderror" name="radius" value="{{ $cab->radius }}">
                            
                                <!-- error message untuk title -->
                                @error('radius')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                 
                                </div>
                            </div>                 
                             <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Satuan Radius <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
				<select class="form-control form-control-sm col-form-input" id="satuan_radius" name="satuan_radius">
                                    <option value="{{ $cab->satuan_radius }}" {{ $cab->satuan_radius == $cab->satuan_radius  ? 'selected' :''}}>{{ $cab->satuan_radius }}</option>
                                    <option value="miles">Mil</option>
                                    <option value="Kilometer">Kilometer</option>
                                    <option value="Meter">Meter</option>
 
                                 </select>
                                </div>
                            </div> 

                           
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Status<span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <select class="form-control form-control-sm col-form-input  @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="{{ $cab->status }}" {{ $cab->status == $cab->status  ? 'selected' :''}}>{{ $cab->status }}</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Non Aktif">Non Aktif</option>
                                 </select>
                                 @error('status_kerja')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                            </div>                            
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Document <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                
                                <input type="file" class="form-control form-control-sm col-form-input @error('dokumen') is-invalid @enderror" name="dokumen">
                                <h5 class="file-before">File Before : 
                                    <a href= '/storage/pelamar/{{$cab->dokumen}}' class='btn btn-info btn-down btn-sm' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Download' target ='blank'>{{$cab->dokumen}}</a>
                                    (Field Document biarkan kosong jika tidak akan di update.)
                                </h5> 
                                
                                    <!-- error message untuk title -->
                                    @error('dokumen')
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

        @endauth

   
@endsection


