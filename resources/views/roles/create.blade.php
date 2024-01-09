@extends('layouts.app-master')

@section('content')
<div class="create-role">
<div class="container">
        <h5 class="title-create-role">Add new role</h5>
        
        @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
            
        <hr class="border"></hr>
		<div class="table-body">
            <h5 class="list-create-role">Add new role and assign permissions.</h5>
            <form method="POST" action="{{ route('roles.store') }}" class="form-check">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="{{ old('name') }}" 
                        type="text" 
                        class="form-control" 
                        name="name" 
                        placeholder="Name" required>
                </div>
                
                <label for="permissions" class="form-label">Assign Permissions</label>

                <table class="table data-table">
                    <thead>
                        <tr class="judul">
                        <th scope="col" width="1%"><input type="checkbox" name="all_permission"> Checkbox</th>
                        <th scope="col" width="2%">Name</th>
                        <th scope="col" width="1%">Guard</th> 
                        </tr>
                        
                    </thead>
                    <tbody>
                    @foreach($permissions as $permission)
                        <tr class="isi" >
                            <td class="checkbox">
                                <input 
                                type="checkbox" 
                                id='permission' 
                                name="permission[{{ $permission->name }}]"
                                value="{{ $permission->name }}">
                            </td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                   
                </table>
                <div class="buton-action" style="">
                    <a href="{{ route('roles.index') }}" class="btn btn-sm btn-back">Back</a>
                    <button type="submit" class="btn btn-sm btn-save">Save</button>
                </div>
            </form>
        </div>
    </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('[name="all_permission"]').on('click', function() {

                if($(this).is(':checked')) {
                    $.each($('#permission'), function() {
                        $(this).prop('checked',true);
                    });
                } else {
                    $.each($('#permission'), function() {
                        $(this).prop('checked',false);
                    });
                }
                
            });
        });
    </script>
@endsection