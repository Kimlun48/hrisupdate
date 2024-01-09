@extends('layouts.app-master')

@section('content')
    <div class="create-posisi">
    <div class="container">
        <h5 class="title-create-posisi">Position Job Create</h5>
        <hr class="border"></hr>
		<div class="table-body">
            <form action="{{route('posisijob.storeedit', [ $jobs->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 row row-body">
                                <label class="col-sm-2 col-form-label">Nama <span class="wajib">*</span></label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control col-form-input @error('nama') is-invalid @enderror" name="nama"
                                value="{{ $jobs->nama}}" >    
                                   
                            
                                <!-- error message untuk title -->
                                @error('nama')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                            </div>
                <div class="mb-3 row row-body">
                                <label class="col-sm-2 col-form-label">Status<span class="wajib">*</span></label>
                                <div class="col-sm-10">
                                <select class="form-control col-form-input  @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="">--Please Select--</option>
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
                <div class="buton-action" style="">
                <a href="{{ URL::previous() }}" class="btn btn-sm btn-back">Back</a>
                <button type="reset" class="btn btn-sm btn-cancel">Cancel</button>
                <button type="submit" class="btn btn-sm btn-save">Save</button>
                </div>

            </form> 
        </div>
    </div>
    </div>
    

@endsection




