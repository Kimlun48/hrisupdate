@extends('layouts.app-master')

@section('content')
    <div class="create-permission">
        <h5 class="title-create-permission">New permission</h5>
        <hr class="border"></hr>
		<div class="table-body">
            <h5 class="list-create-permission">Add new permission</h5>		
            <form action="{{ route('permissions.store') }}" method="POST">
                @csrf
                <div class="form-group">
                <input value="{{ old('name') }}" 
                        type="text" 
                        class="form-control" 
                        name="name" 
                        placeholder="Enter New Permission" required>

                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="buton-action" style="">
                <a href="{{ URL::previous() }}" class="btn btn-sm btn-back">Back</a>
                <button type="reset" class="btn btn-sm btn-cancel">Cancel</button>
                <button type="submit" class="btn btn-sm btn-save">Save</button>
                </div>
            </form> 
        </div>
    </div>
    

@endsection