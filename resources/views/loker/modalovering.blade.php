<!-- Modal Overing -->
<div class="modal fade bd-example-modal-lg" id="exampleModalOvering" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel">Process {{$det->progres}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="{{ route('verif.storeoffering') }}" method="POST">
       @csrf
	<div class="mb-3 row row-body">
          <input type="hidden"  id="cekidovering" name="cekidovering">

	   <div class="mb-3 row row-body">
             <label class="col-sm-2 col-form-label">Waktu Tes <span class="wajib">*</span></label>
               <div class="col-sm-5">
                <input class="form-control col-form-input" type="date" id="waktu" name="waktu">
                  @error('waktu')
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
                                <input class="form-control col-form-input" id="nama" name="nama" readonly value={{ $list->pelamar->nama_lengkap}} >                              
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
                                     <option value="{{ $leveljabatan->id }}">{{ $leveljabatan->nama }}</option>
                                   @endforeach
                                 </select>
                                </div>
                            </div>
                            <!-- leveljabatans
                            <div class="mb-3 row row-body">
                                <label class="col-sm-2 col-form-label">Jabatan <span class="wajib">*</span></label>
                                <div class="col-sm-5">
                                <input class="form-control col-form-input" id="fk_level_jabatan" name="fk_level_jabatan" readonly value={{ $list->loker->level_job}} >                              
                                @error('jabatan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                            </div>                              -->
                            <!-- {{-- <div class="mb-3 row row-body">
                                <label class="col-sm-2 col-form-label">Bagian <span class="wajib">*</span></label>
                                <div class="col-sm-5">
                                <select class="form-control col-form-input" id="jabatan" name="jabatan" >
                                   @foreach ($jabats as $jab)
                                     <option value="{{ $jab->id }}">{{ $jab->nama }}</option>
                                   @endforeach
                                 </select>
                                </div>
                            </div> --}} -->
                            <div class="mb-3 row row-body">
                                <label class="col-sm-2 col-form-label">Bagian <span class="wajib">*</span></label>
                                <div class="col-sm-5">
                                <select class="form-control col-form-input" id="fk_bagian" name="fk_bagian">
                                   @foreach ($bags as $bag)
                                     <option value="{{ $bag->id }}">{{ $bag->nama }}</option>
                                   @endforeach
                                 </select>
                                </div>
                            </div>

                            <div class="mb-3 row row-body">
                                <label class="col-sm-2 col-form-label">Cabang <span class="wajib">*</span></label>
                                <div class="col-sm-5">
                                <select class="form-control col-form-input" id="fk_cabang" name="fk_cabang">
                                   @foreach ($cabs as $cab)
                                     <option value="{{ $cab->id }}">{{ $cab->nama }}</option>
                                   @endforeach
                                 </select>
                                </div>
                            </div>
                                                        
                            <div class="mb-3 row row-body">
                                <label class="col-sm-2 col-form-label">Komponen Upah <span class="wajib">*</span></label>
                                <div class="col-sm-5">
                               <input class="form-control col-form-input" type="text" id="upah" name="upah">    

                            
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
                                     placeholder="Add Lain-lain" value="{{ old('lain_lain') }}"></textarea>
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
                                        <option value="Probation">Probation</option>
                                        <option value="PHL">PHL</option>
                                        <option value="PKWT">PKWT</option>
                                        <option value="PKWTT">PKWTT</option>

                                        
                                 </select>
                                 @error('status_kerja')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                            </div>

                            <div class="mb-3 row row-body">
                                <label class="col-sm-2 col-form-label">Tanggal Join <span class="wajib">*</span></label>
                                <div class="col-sm-5">
                                <input class="form-control col-form-input" type="date" id="tanggal_masuk" name="tanggal_masuk">                              
                                @error('tanggal_masuk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                            </div> 
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
	<button type="submit" class="btn btn-primary" onclick="$('#cover-spin').show(0)">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Overing-->


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

