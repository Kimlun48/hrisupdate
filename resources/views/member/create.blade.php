
@extends('layouts.app-master')

@section('member')

    <div class="create-branch">
        <div class="container">
        <h5 class="title-branch">Create Member Ads <hr class="garis-branch"></h5>
        <h5 class="text-create-1">Mohon mengisi bagian yang ditandai (*) dengan lengkap.</h5>
        <h5 class="text-create-2">Please input your information for required field (*)</h5>
        <hr>
        <form action="{{ route('member.store') }}" method="POST" enctype="multipart/form-data">
        <div class="container container-branch">
            <div class="row row-branch">
                <div class="col col-branch">
                <h5 class="card-title">Member Detail</h5>
                    <div class="card card-branch">
                        <div class="card-body">
                        @csrf

        
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Name <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="text" class="form-control form-control-sm col-form-input @error('nama') is-invalid @enderror" name="nama"
                                    value="{{ old('nama') }}" id="nama" placeholder="Input Name Member" pattern="[^()/><\][\\\x22,;|]+">
                            
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
                                <input type="text" class="form-control form-control-sm col-form-input @error('idtype') is-invalid @enderror" name="idtype"
                                    value="{{ old('idtype') }}" placeholder="Input ID Card" pattern="[^()/><\][\\\x22,;|]+" maxlength="16">
                            
                                <!-- error message untuk title -->
                                @error('idtype')
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
                                value="{{ old('tempatlahir') }}" placeholder="Input Place Of Birth" pattern="[^()/><\][\\\x22,;|]+" id="tempatlahir">
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
                                value="{{ old('tgllahir') }}" placeholder="Input Address" pattern="[^()/><\][\\\x22,;|]+">
                                    <!-- error message untuk title -->
                                    @error('tgllahir')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
			    </div>           
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Phone Number <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="text" class="form-control form-control-sm col-form-input @error('notelp') is-invalid @enderror" name="notelp"
                                value="{{ old('notelp') }}" placeholder="Input Phone Number" pattern="[^()/><\][\\\x22,;|]+">
                                    <!-- error message untuk title -->
                                    @error('notelp')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Gender<span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <select class="form-control form-control-sm col-form-input  @error('gender') is-invalid @enderror" id="gender" name="gender">
                                    <option value="" selected disabled>--Select Gender--</option>
                                    <option value="LAKI-LAKI">Laki-laki</option>
                                    <option value="PEREMPUAN">Perempuan</option>
                                </select>
                                @error('gender')
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
                                    <option value="" selected disabled>--Select Religion--</option>
				    <option value="ISLAM">Islam</option>
				    <option value="KATHOLIK">Katholik</option>
                                    <option value="PROTESTAN">Protestan</option>
                                    <option value="BUDHA">Budha</option>
                                    <option value="HINDU">Hindu</option>
                                 </select>
                                 @error('gender')
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
                                value="{{ old('alamat') }}" placeholder="Input Address" pattern="[^/><\][\\\x22;|]+" id="alamat">
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
                                value="{{ old('provinsi') }}" placeholder="Input province" pattern="[^()/><\][\\\x22,;|]+" id="provinsi">
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
                                value="{{ old('kota') }}" placeholder="Input Ciy" pattern="[^()/><\][\\\x22,;|]+" id="kota">
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
                                value="{{ old('kecamatan') }}" placeholder="Input District" pattern="[^()/><\][\\\x22,;|]+" id="kecamatan">
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
                                value="{{ old('kelurahan') }}" placeholder="Input Ward" pattern="[^()/><\][\\\x22,;|]+" id="kelurahan">
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
                                value="{{ old('kodepos') }}" placeholder="Input Posttal Code" pattern="[^()/><\][\\\x22,;|]+">
                                    <!-- error message untuk title -->
                                    @error('kodepos')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Status Marital<span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <select class="form-control form-control-sm col-form-input  @error('statusnikah') is-invalid @enderror" id="statusnikah" name="statusnikah">
                                    <option value="" selected disabled>--Select Status Marital--</option>
                                    <option value="BELUM MENIKAH">Belum Menikah</option>
                                    <option value="MENIKAH">Menikah</option>
                                    <option value="JANDA">Janda</option>
                                    <option value="DUDA">Duda</option>
                                 </select>
                                 @error('statusnikah')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                            </div>
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Email <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="email" class="form-control form-control-sm col-form-input @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" placeholder="Input Email" pattern="[^()/><\][\\\x22,;|]+" id="email">
                            
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
                                value="{{ old('job') }}" placeholder="Input Job" pattern="[^()/><\][\\\x22,;|]+" id="job">
                                    <!-- error message untuk title -->
                                    @error('job')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            
                            
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Last Education <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <select class="form-control form-control-sm col-form-input @error('pendididkan') is-invalid @enderror" id="pendididkan" name="pendididkan">
                                    <option value="" selected disabled>--Select Last Education--</option>
                                    <option value="SD">SD</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SMA">SMA</option>
                                    <option value="S1">S1</option>
                                    <option value="S2">S2</option>
                                    <option value="S3">S3</option>
                                 </select>
                                 @error('pendididkan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                            </div> 
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Status Member <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <select class="form-control form-control-sm col-form-input @error('statusaktif') is-invalid @enderror" id="statusaktif" name="statusaktif">
                                    <option value="" selected disabled>--Select Status Member--</option>
                                    <option value=0>Non Aktif</option>
                                    <option value=1>Aktif</option>
                                 </select>
                                 @error('statusaktif')
                                 <div class="alert alert-danger mt-2">
                                     {{ $message }}
                                 </div>
                                 @enderror
                                </div>
                            </div> 
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">loyalty Code <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="text" class="form-control form-control-sm col-form-input @error('loyaltycode') is-invalid @enderror" name="loyaltycode" 
                                value="{{ old('loyaltycode') }}" placeholder="Input Loyalty Code" pattern="[^()/><\][\\\x22,;|]+" id="loyaltycode">
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
                                        <option value="" selected disabled>--Select Loyalty Categori--</option>
                                        <option value="SILVER">Silver</option>
                                        <option value="GOLD">Gold</option>
                                        <option value="PLATINUM">Platinum</option>
                                 </select>
                                 @error('loyaltykategori')
                                 <div class="alert alert-danger mt-2">
                                     {{ $message }}
                                 </div>
                                 @enderror
                                </div>
                            </div> 
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Loyalty Potensi <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <select class="form-control form-control-sm col-form-input @error('loyaltypotensi') is-invalid @enderror" id="loyaltypotensi" name="loyaltypotensi">
                                        <option value="" selected disabled>--Select Loyalty Potensi--</option>
                                        <option value="LOW">low</option>
                                        <option value="MEDIUM">Medium</option>
                                        <option value="HIGHT">Hight</option>
                                </select>
                                @error('loyaltypotensi')
                                 <div class="alert alert-danger mt-2">
                                     {{ $message }}
                                 </div>
                                 @enderror
                                </div>
                            </div>
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">idnum <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="text" class="form-control form-control-sm col-form-input @error('idnum') is-invalid @enderror" name="idnum" 
                                value="{{ old('idnum') }}" placeholder="Input idnum" pattern="[^()/><\][\\\x22,;|]+" id="idnum">
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


$(document).ready(function()
{
    $('#nama,#tempatlahir,#alamat,#provinsi,#kota,#kecamatan,#kelurahan,#job,#loyaltycode,#idnum').keyup(function()
    {
        $(this).val($(this).val().toUpperCase());
    });
});

$(document).ready(function()
{
    $('#email').keyup(function()
    {
        $(this).val($(this).val().toLowerCase());
    });
});
</script> 
@endsection

