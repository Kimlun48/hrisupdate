
@extends('layouts.app-master')

@section('member')

    <div class="create-branch">
        <div class="container">
        <h5 class="title-branch">Edit Member Ads <hr class="garis-branch"></h5>
        <h5 class="text-create-1">Mohon mengisi bagian yang ditandai (*) dengan lengkap.</h5>
        <h5 class="text-create-2">Please input your information for required field (*)</h5>
        <hr>
        <form action="{{ route('member.storeedit', $mems->id) }}" method="POST" enctype="multipart/form-data">
        <div class="container container-branch">
            <div class="row row-branch">
                <div class="col col-branch">
                <h5 class="card-title">Edit Member Detail</h5>
                    <div class="card card-branch">
                        <div class="card-body">
                        @csrf

        
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Name <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="text" class="form-control form-control-sm col-form-input @error('nama') is-invalid @enderror" name="nama"
                                    value="{{$mems->nama }}" placeholder="Input Name Member" pattern="[^()/><\][\\\x22,;|]+">
                            
                                <!-- error message untuk title -->
                                @error('nama')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                 
                                </div>
                            </div>
                            
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">ID Card <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="text" readonly class="form-control form-control-sm col-form-input @error('idtype') is-invalid @enderror" name="idtype"
                                    value="{{ $mems->idtype }}" placeholder="Input ID Card" pattern="[^()/><\][\\\x22,;|]+">
                            
                                <!-- error message untuk title -->
                                @error('idtype')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                 
                                </div>
                            </div>              
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Gender<span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <select class="form-control form-control-sm col-form-input" id="gender" name="gender">
                                    <option value="{{ $mems->gender }}" {{ $mems->gender == $mems->gender  ? 'selected' :''}}>{{ $mems->gender }}</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                 </select>
                                </div>
			    </div>             
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Phone <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="text" class="form-control form-control-sm col-form-input @error('notelp') is-invalid @enderror" name="notelp" 
                                value="{{ $mems->idtype }}" placeholder="Input Phone" pattern="[^()/><\][\\\x22,;|]+">
                                    <!-- error message untuk title -->
                                    @error('notelp')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
 
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Status Marital<span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <select class="form-control form-control-sm col-form-input @error('statusnikah') is-invalid @enderror" id="statusnikah" name="statusnikah">
                                    <option value="{{ $mems->statusnikah }}" {{ $mems->statusnikah == $mems->statusnikah  ? 'selected' :''}}>{{ $mems->statusnikah }}</option>
                                    <option value="Belum_Menikah">Belum Menikah</option>
                                    <option value="Menikah">Menikah</option>
                                    <option value="Janda">Janda</option>
                                    <option value="Duda">Duda</option>
                                 </select>
                                </div>
                            </div>    

                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Email <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="email" class="form-control form-control-sm col-form-input @error('email') is-invalid @enderror" name="email"
                                    value="{{ $mems->email }}" placeholder="Input Email" pattern="[^()/><\][\\\x22,;|]+">
                            
                                <!-- error message untuk title -->
                                @error('email')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                 
                                </div>
                            </div>                                       
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Job <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="text" class="form-control form-control-sm col-form-input @error('job') is-invalid @enderror" name="job"
                                value="{{$mems->job }}" placeholder="Input Job">
                                    <!-- error message untuk title -->
                                    @error('job')
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
                                value="{{ $mems->alamat }}" placeholder="Input Address">
                                    <!-- error message untuk title -->
                                    @error('alamat')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Province <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="text" class="form-control form-control-sm col-form-input @error('provinsi') is-invalid @enderror" name="provinsi" 
                                value="{{ $mems->provinsi }}" placeholder="Input province">
                                    <!-- error message untuk title -->
                                    @error('provinsi')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">City <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="text" class="form-control form-control-sm col-form-input @error('kota') is-invalid @enderror" name="kota" 
                                value="{{$mems->kota }}" placeholder="Input Ciy">
                                    <!-- error message untuk title -->
                                    @error('kota')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">District <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="text" class="form-control form-control-sm col-form-input @error('kecamatan') is-invalid @enderror" name="kecamatan" 
                                value="{{ $mems->kecamatan }}" placeholder="Input District">
                                    <!-- error message untuk title -->
                                    @error('kecamatan')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Ward <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="text" class="form-control form-control-sm col-form-input @error('kelurahan') is-invalid @enderror" name="kelurahan" 
                                value="{{ $mems->kelurahan }}" placeholder="Input Ward">
                                    <!-- error message untuk title -->
                                    @error('kelurahan')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Postal Code <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="text" class="form-control form-control-sm col-form-input @error('kodepos') is-invalid @enderror" name="kodepos" 
                                value="{{ $mems->kodepos }}" placeholder="Input Posttal Code">
                                    <!-- error message untuk title -->
                                    @error('kodepos')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Place of birth <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="text" class="form-control form-control-sm col-form-input @error('tempatlahir') is-invalid @enderror" name="tempatlahir" 
                                value="{{ $mems->tempatlahir }}" placeholder="Input Address">
                                    <!-- error message untuk title -->
                                    @error('tempatlahir')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Date of birth <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="date" class="form-control form-control-sm col-form-input @error('tgllahir') is-invalid @enderror" name="tgllahir" 
                                value="{{$mems->tgllahir }}" placeholder="Input Address">
                                    <!-- error message untuk title -->
                                    @error('tgllahir')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Religion<span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <select class="form-control form-control-sm col-form-input @error('agama') is-invalid @enderror" id="agama" name="agama">
                                    <option value="{{ $mems->agama }}" {{ $mems->agama == $mems->agama  ? 'selected' :''}}>{{ $mems->agama }}</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Budha">Budha</option>
                                    <option value="Hindu">Hindu</option>
                                 </select>
                                </div>
                            </div>
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Last Education <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <select class="form-control form-control-sm col-form-input @error('pendididkan') is-invalid @enderror" id="pendididkan" name="pendididkan">
                                    <option value="{{ $mems->pendididkan }}" {{ $mems->pendididkan == $mems->pendididkan  ? 'selected' :''}}>{{ $mems->pendididkan }}</option>
                                    <option value="SD">SD</option>
                                    <option value="SMP">SMP</option>
				    <option value="SMA">SMA</option>
                                    <option value="D3">D3</option>
                                    <option value="S1">S1</option>
                                    <option value="S2">S2</option>
                                    <option value="S3">S3</option>
                                 </select>
                                </div>
                            </div> 
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Status Member <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <select class="form-control form-control-sm col-form-input @error('statusaktif') is-invalid @enderror" id="statusaktif" name="statusaktif">
                                    <option value="{{ $mems->statusaktif }}" {{ $mems->statusaktif == $mems->statusaktif  ? 'selected' :''}}>{{ $mems->statusaktif }}</option>
                                    <option value=0>Non Aktif</option>
                                    <option value=1>Aktif</option>
                                 </select>
                                </div>
                            </div> 
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">loyalty Code <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="text" class="form-control form-control-sm col-form-input @error('loyaltycode') is-invalid @enderror" name="loyaltycode" 
                                value="{{$mems->loyaltycode }}" placeholder="Input Loyalti Code">
                                    <!-- error message untuk title -->
                                    @error('loyaltycode')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Loyalty Categori <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <select class="form-control form-control-sm col-form-input @error('loyaltykategori') is-invalid @enderror" id="loyaltykategori" name="loyaltykategori">
                                        <option value="{{ $mems->loyaltykategori }}" {{ $mems->loyaltykategori == $mems->loyaltykategori  ? 'selected' :''}}>{{ $mems->loyaltykategori }}</option>
                                        <option value="Silver">Silver</option>
                                        <option value="Gold">Gold</option>
                                        <option value="Platinum">Platinum</option>
                                 </select>
                                </div>
                            </div> 
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Loyalty Potensi <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <select class="form-control form-control-sm col-form-input @error('loyaltypotensi') is-invalid @enderror" id="loyaltypotensi" name="loyaltypotensi">
                                    <option value="{{ $mems->loyaltypotensi }}" {{ $mems->loyaltypotensi == $mems->loyaltypotensi  ? 'selected' :''}}>{{ $mems->loyaltypotensi }}</option>
                                        <option value="Low">low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Hight">Hight</option>
                                 </select>
                               
                                 </select>
                                </div>
                            </div>
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">idnum <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="text" class="form-control form-control-sm col-form-input @error('idnum') is-invalid @enderror" name="idnum" 
                                value="{{ $mems->idnum }}" placeholder="Input Address">
                                    <!-- error message untuk title -->
                                    @error('idnum')
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


   
@endsection

