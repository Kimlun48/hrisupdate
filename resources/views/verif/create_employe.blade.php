@extends('layouts.app-master')

@section('content')
<div class="create-verif">
<div class="container">
        @auth
        <h5 class="title-create">Process Applicant <hr class="garis-create"></h5>
        <h5 class="text-create-1">Mohon mengisi bagian yang ditandai (*) dengan lengkap.</h5>
        <h5 class="text-create-2">Please input your information for required field (*)</h5>
        <hr>
        <form action="{{ route('verif.storeemploye', $idtea) }}" method="POST">
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

                            <div class="mb-3 row row-body">
                                <label class="col-sm-2 col-form-label">Nama <span class="wajib">*</span></label>
                                <div class="col-sm-5">
                                <input class="form-control col-form-input" id="nama" name="nama" readonly value="{{ $list->pelamar->nama_lengkap}}" >                              
                                @error('nama')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                            </div> 

                            <div class="mb-3 row row-body">
                                <label class="col-sm-2 col-form-label">Jabatan <span class="wajib">*</span></label>
                                <div class="col-sm-5">
                                <select class="form-control col-form-input" id="fk_level_jabatan" name="fk_level_jabatan">
                                   @foreach ($leveljabatans as $leveljabatan)
                                     <option value="{{ $leveljabatan->id }}" {{ $leveljabatan->id == $offering->fk_level_jabatan ? 'selected' :''}} >{{ $leveljabatan->nama }}</option>
                                   @endforeach
                                 </select>
                                </div>
                            </div>                            
                            
                            <div class="mb-3 row row-body">
                                <label class="col-sm-2 col-form-label">Bagian <span class="wajib">*</span></label>
                                <div class="col-sm-5">
                                <select class="form-control col-form-input" id="fk_bagian" name="fk_bagian">
                                   @foreach ($bags as $bag)
                                     <option value="{{ $bag->id }}" {{ $bag->id == $offering->bagian->id ? 'selected' :''}}>{{ $bag->nama }} </option>
                                   @endforeach
                                 </select>
                                </div>
                            </div>
                            <div class="mb-3 row row-body">
                                <label class="col-sm-2 col-form-label">Cabang <span class="wajib">*</span></label>
                                <div class="col-sm-5">
                                <select class="form-control col-form-input" id="fk_cabang" name="fk_cabang" >
                                        @foreach ($cabs as $cab)
                                            <option value="{{ $cab->id }}" {{ $cab->id == $offering->cabang->id ? 'selected' :''}} >{{ $cab->nama }}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>
      
                            <div class="mb-3 row row-body">
                                <label class="col-sm-2 col-form-label">Komponen Upah <span class="wajib">*</span></label>
                                <div class="col-sm-5">
                               <input class="form-control col-form-input" type="text" id="upah" name="upah" value="{{$offering->upah}}">    

                            
                                @error('upah')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>

                                @enderror
                                </div>
			    </div> 

                           <div class="mb-3 row row-body">
                                <label class="col-sm-2 col-form-label">Lain-Lain <span class="wajib">*</span></label>
                                <div class="col-sm-10">
                                    <textarea class="form-control col-form-input  @error('lain_lain') is-invalid @enderror" id="lain_lain" name="lain_lain" rows="5"
                                     placeholder="Add Lain-lain"></textarea>
                                    @error('lain_lain')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                            </div>     

                            <div class="mb-3 row row-body">
                                <label class="col-sm-2 col-form-label">Keterangan <span class="wajib">*</span></label>

                                <div class="col-sm-10">
                                    <textarea class="form-control col-form-input  @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="5"
                                     placeholder="Add Keterangan" value="{{ old('keterangan') }}"></textarea>
                                    @error('keterangan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                            </div>

                            <div class="mb-3 row row-body">
                                <label class="col-sm-2 col-form-label">Status Kerja<span class="wajib">*</span></label>
                                <div class="col-sm-5">
				<select class="form-control col-form-input  @error('status_kerja') is-invalid @enderror" id="status_kerja" name="status_kerja">
                                        <option value="">--Please Select--</option>
					<option value="Probation">Probation</option>
                                        <option value="Contract">Contract</option>
					<option value="Permanent">Permanent</option>
				        <!-- <option value="PHL">PHL</option> -->

                                 </select>
                                 @error('status_kerja')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                            </div>
                            <div class="mb-3 row row-body">
                                <label class="col-sm-2 col-form-label">Jenis Karyawan<span class="wajib">*</span></label>
                                <div class="col-sm-5">
                                <select class="form-control col-form-input  @error('jenis_karyawan') is-invalid @enderror" id="jenis_karyawan" name="jenis_karyawan">
                                <option value="">--Please Select--</option>
                                <option value="Internal">Internal</option>
                                        <option value="Eksternal">Eksternal</option>
                                 </select>
                                 @error('jenis_karyawan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
			    </div>

                            <div class="mb-3 row row-body">
                                <label class="col-sm-2 col-form-label">Tanggal Join <span class="wajib">*</span></label>
                                <div class="col-sm-5">
                                <input class="form-control col-form-input" type="date" id="tanggal_masuk" name="tanggal_masuk"  value="{{ $offering->tanggal_masuk }}">                              
                                @error('tanggal_masuk')
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
                <!-- <button type="reset" class="btn btn-md btn-reset">Cancel</button> -->
                <button type="submit" class="btn btn-md btn-simpan" onclick="$('#cover-spin').show(0)">Submit</button>
                </div>
                <div class="col-lg-1 col-btn">
                <a href="{{ URL::previous() }}" class="btn btn-md btn-reset">Cancel</a>
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
    ClassicEditor
    .create( document.querySelector( '#keterangan' ) )
    .catch( error => {
        console.log( error );
    } );
    ClassicEditor
    .create( document.querySelector( '#lain_lain' ) )
    .catch( error => {
        console.log( error );
    } );    
    // CKEDITOR.replace( 'kualifikasi');
    // CKEDITOR.replace( 'deskripsi' );
    // CKEDITOR.replace( 'ringkasan_kualifikasi' );
</script>


<script type="text/javascript">

	/* Tanpa Rupiah */
	var tanpa_rupiah = document.getElementById('upah');
	tanpa_rupiah.addEventListener('keyup', function(e)
	{
		tanpa_rupiah.value = formatRupiah(this.value);
	});

	tanpa_rupiah.addEventListener('keydown', function(event)
	{
		limitCharacter(event);
	});

	/* Fungsi */
	function formatRupiah(bilangan, prefix)
	{
		var number_string = bilangan.replace(/[^,\d]/g, '').toString(),
			split	= number_string.split(','),
			sisa 	= split[0].length % 3,
			rupiah 	= split[0].substr(0, sisa),
			ribuan 	= split[0].substr(sisa).match(/\d{1,3}/gi);

		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}

		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}

	function limitCharacter(event)
	{
		key = event.which || event.keyCode;
		if ( key != 188 // Comma
			 && key != 8 // Backspace
			 && key != 17 && key != 86 & key != 67 // Ctrl c, ctrl v
			 && (key < 48 || key > 57) // Non digit
			 // Dan masih banyak lagi seperti tombol del, panah kiri dan kanan, tombol tab, dll
			)
		{
			event.preventDefault();
			return false;
		}
	}
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
