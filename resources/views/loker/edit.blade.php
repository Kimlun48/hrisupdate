@extends('layouts.app-master')

@section('content')

    <div class="create-job">
        @auth
        <h5 class="title-create">Edit Job Ads <hr class="garis-create"></h5>
        <h5 class="text-create-1">Mohon mengisi bagian yang ditandai (*) dengan lengkap.</h5>
        <h5 class="text-create-2">Please input your information for required field (*)</h5>
	<hr>
        <form action="/loker/storeedit/{{ $loks->id }}/" method="POST" enctype="multipart/form-data">
        <div class="container container-create">
            <div class="row row-create">
                <div class="col col-create">
                <h5 class="card-title">Edit Job Detail</h5>
                    <div class="card card-create">
                        <div class="card-body">
                        @csrf
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Position Title <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="text" class="form-control form-control-sm col-form-input @error('lowongan_kerja') is-invalid @enderror" name="lowongan_kerja"
                                value="{{ $loks->lowongan_kerja }}" placeholder="Masukkan Lowongan Kerja">
                            
                                <!-- error message untuk title -->
                                @error('lowongan_kerja')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                 
                                </div>
                            </div>
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Employment Title <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <select class="form-control col-form-input form-control-sm" id="posisi_id" name="posisi_id">
                                   @foreach ($posisijobs as $posisi)
                                   <option value="{{ $posisi->id }}" {{ $posisi->id == $loks->posisi_id  ? 'selected' :''}}>{{ $posisi->nama }}</option>
                                   @endforeach
                                 </select>
                                </div>
                            </div>
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Work Location <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <select class="form-control col-form-input form-control-sm" id="fk_penempatan" name="fk_penempatan">
                                   @foreach ($cabs as $cab)
                                   <option value="{{ $cab->id }}" {{ $cab->id == $loks->fk_penempatan  ? 'selected' :''}}>{{ $cab->nama }}</option>
                                   @endforeach
                                 </select>
                                </div>
                            </div>

                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Header <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="file"  accept="image/*" class="form-control form-control-sm col-form-input @error('dok_header') is-invalid @enderror" name="dok_header">
                                <h5 class="file-before">File Before : 
                                    <a href= '/storage/images/posts/{{$loks->dok_header}}' class='btn btn-info btn-down btn-sm text-truncate' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Download' target ='blank'>{{$loks->dok_header}}</a>
                                    (Field Header biarkan kosong jika tidak akan di update.)
                                </h5> 
                                    <!-- error message untuk title -->
                                    @error('dok_header')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Poster <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                
                                <input type="file"  accept="image/*" class="form-control form-control-sm col-form-input @error('dok_poster') is-invalid @enderror" name="dok_poster">
                                <h5 class="file-before">File Before : 
                                    <a href= '/storage/images/posts/{{$loks->dok_poster}}' class='btn btn-info btn-down btn-sm' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Download' target ='blank'>{{$loks->dok_poster}}</a>
                                    (Field Poster biarkan kosong jika tidak akan di update.)
                                </h5> 
                                    <!-- error message untuk title -->
                                    @error('dok_poster')
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

            <div class="row row-create">
                <div class="col col-create">
                <h5 class="card-title">Edit Job Description</h5>
                    <div class="card card-create">
                        <div class="card-body">
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Description <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <textarea class="form-control col-form-input @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5"
                                    placeholder="Masukan Konten Post"  value="{{ $loks->deskripsi }}" >{{ $loks->deskripsi }}</textarea>
                            
                                <!-- error message untuk title -->
                                @error('deskripsi')
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

            <div class="row row-create">
                <div class="col col-create">
                <h5 class="card-title">Edit Requirement</h5>
                    <div class="card card-create">
                        <div class="card-body">
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Description <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <textarea class="form-control col-form-input @error('kualifikasi') is-invalid @enderror" id="kualifikasi" name="kualifikasi" rows="5"
                                     placeholder="Masukkan Konten Post" value="{{ $loks->kualifikasi }}">{{ $loks->kualifikasi }}</textarea>
                            
                                <!-- error message untuk content -->
                                @error('kualifikasi')
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

            <div class="row row-create">
                <div class="col col-create">
                <h5 class="card-title">Edit Jobs Summary</h5>
                    <div class="card card-create">
                        <div class="card-body">
                        @csrf
                            <div class="mb-3 row row-body">
                               <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Job Level <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <select class="form-control form-control-sm col-form-input" id="level_job" name="level_job">
                                    <option value="{{ $loks->level_job }}" {{ $loks->level_job == $loks->level_job  ? 'selected' :''}}>{{ $loks->level_job }}</option>
                                    <option value="Staff">Staff</option>
                                    <option value="Admin">Admin</option>
                                    <option value="SPV">SPV</option>
                                    <option value="Managar">Managar</option>
                                </select>                                   
                                </div>
                            </div>

                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Year of experience <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="text" class="form-control form-control-sm col-form-input @error('pengalaman') is-invalid @enderror" name="pengalaman"
                                value="{{ $loks->pengalaman }}" placeholder="Masukkan Pengalaman">
                                <!-- error message untuk title -->
                                @error('pengalaman')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                            </div>
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Education <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <select class="form-control form-control-sm col-form-input" id="pendidikan" name="pendidikan">
                                    <option value="{{ $loks->pendidikan }}" {{ $loks->pendidikan == $loks->pendidikan  ? 'selected' :''}}>{{ $loks->pendidikan }}</option>
                                    <option value="SMA">SMA</option>
                                    <option value="Diploma 1">Diploma 1</option>
                                    <option value="Diploma 2">Diploma 2</option>
                                    <option value="Diploma 3">Diploma 3</option>
                                    <option value="Diploma 4">Diploma 4</option>
                                    <option value="Strata 1">Strata 1</option>
                                    <option value="Strata 2">Strata 2</option>
                                </select>                                   
                                </div>
                            </div>
                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 form-control-sm col-form-label">Job Category <span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <input type="text" class="form-control form-control-sm col-form-input @error('kategory_job') is-invalid @enderror" name="kategory_job"
                                value="{{ $loks->kategory_job }}" placeholder="Masukkan Kategory Job">
                                <!-- error message untuk title -->
                                @error('kategory_job')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                            </div>

                            <div class="mb-3 row row-body">
                                <label class="col-sm-3 col-md-3 col-lg-2 col-xl-2 col-form-label">Status Vacancy<span class="wajib">*</span></label>
                                <div class="col-sm-9 col-md-9 col-lg-10 col-xl-10">
                                <select class="form-control form-control-sm col-form-input  @error('status') is-invalid @enderror" id="status" name="status">
                                <option value="{{ $loks->status }}" {{ $loks->status == $loks->status  ? 'selected' :''}}>{{ $loks->status }}</option>
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
</form>

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
    .create( document.querySelector( '#kualifikasi' ) )
    .catch( error => {
        console.log( error );
    } );
    ClassicEditor
    .create( document.querySelector( '#deskripsi' ) )
    .catch( error => {
        console.log( error );
    } );
</script>
        @endauth

        @guest
        <h1>Create Job Ads</h1>
        <h5>Mohon mengisi bagian yang ditandai (*) dengan lengkap.<h5>
        <h5>Please input your information for required field (*)</h5>
				
 </tbody>
 </table>
 
 </div>
        @endguest
   
@endsection


