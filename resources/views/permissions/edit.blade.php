@extends('layouts.app-master')

@section('content')

<div class="edit-permission">
        <h5 class="title-edit-permission">Edit Permission</h5>
        <hr class="border"></hr>
		<div class="table-body">
            <h5 class="list-edit-permission">Editing Permission</h5>
            <form method="POST" action="{{ route('permissions.update', $permission->id) }}">
                @method('patch')
                @csrf
                <div class="mb-3">
                    <input value="{{ $permission->name }}" 
                        type="text" 
                        class="form-control" 
                        name="name" 
                        placeholder="Name" required>

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