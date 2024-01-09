<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Data Post - SantriKoding.com</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('loker.store') }}" method="POST" enctype="multipart/form-data">
                        
                            @csrf

			     <div class="form-group">
                               <label for="position-option">Posisi</label>
                                 <select class="form-control" id="position-option" name="posisi_id">
                                   @foreach ($posisijobs as $posisi)
                                     <option value="{{ $posisi->id }}">{{ $posisi->nama }}</option>
                                   @endforeach
                                 </select>
                             </div>
                             <div class="form-group">
                                <label class="font-weight-bold">Penempatan</label>
				<input type="text" class="form-control @error('penempatan') is-invalid @enderror" name="penempatan"
                                    value="{{ old('penempatan') }}" placeholder="Masukkan Penempatan Kerja">
                            
                                <!-- error message untuk title -->
                                @error('penempatan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                             <div class="form-group">
                                <label class="font-weight-bold">Lokasi</label>
				<input type="text" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi"
                                   value="{{ old('lokasi') }}" placeholder="Masukkan Lokasi">
                            
                                <!-- error message untuk title -->
                                @error('lokasi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                         <div class="form-group">
				<label class="font-weight-bold">Deskripsi</label>
				<textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="5"
                                    placeholder="Masukkan Konten Post">{{ old('deskripsi') }}</textarea>
                            
                                <!-- error message untuk title -->
                                @error('deskripsi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Kualifikasi</label>
				<textarea class="form-control @error('kualifikasi') is-invalid @enderror" name="kualifikasi" rows="5"
                                     placeholder="Masukkan Konten Post">{{ old('kualifikasi') }}</textarea>
                            
                                <!-- error message untuk content -->
                                @error('kualifikasi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'kualifikasi');
    CKEDITOR.replace( 'deskripsi' );
</script>
</body>
</html>

