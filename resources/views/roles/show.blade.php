@extends('layouts.app-master')

@section('content')
<div class="roles-show">
<div class="container">
    <h5 class="title-roles-show">{{ ucfirst($role->name) }} Role</h5>
    <hr class="border"></hr>
    <div class="table-body">
        <h5 class="list-roles-show">Assigned permissions</h5>
        <table class="table data-table">
                <thead>
                    <th scope="col" width="20%">Module Name</th>
                </thead>

                @foreach($rolePermissions as $permission)
                    <tr>
                        <td>{{ $permission->name }}</td>
                    </tr>
                @endforeach
            </table>

            
                <div class="buton-action" style="">
                    <a href="{{ URL::previous() }}" class="btn btn-sm btn-back">Back</a>
                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-save">Edit</a>
                </div>
    </div>
</div>
</div>


@endsection
    
