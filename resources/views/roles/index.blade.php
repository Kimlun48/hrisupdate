@extends('layouts.app-master')

@section('content')
<div class="roles">
    <h5 class="title-roles">Permission Group</h5>
    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>
    <hr class="border"></hr>
    <div class="table-body">
        <h5 class="list-roles">Manage Your Permission Group</h5>
        <a href="{{ route('roles.create') }}" class="btn btn-sm btn-add mb-3"><i class="fas fa-plus"></i> Add Permission Group</a>			
        <table class="table data-table">
            <thead >
            <tr class="judul" >
             <th width="35%">No</th>
             <th>Group Name</th>
             <th width="13%">Action</th>
          </tr>
            </thead>
          <tbody>
          @foreach ($roles as $key => $role)
            <tr class="isi">
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('roles.show', $role->id) }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Show"><i class="fas fa-eye" style="color:#fff; width:20px"></i></a>
                    <a class="btn btn-primary btn-sm" href="{{ route('roles.edit', $role->id) }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"><i class="fas fa-pencil-alt" style="color:#fff; width:20px"></i></a>
                </td>
               
                <td>
                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('roles.destroy', $role->id) }}" method="POST">
                            <div class="form-group" style="height: 10px" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete">
                            <input type="submit" class="btn btn-sm btn-danger" value="" style="width: 40px">
                            <i class="fas fa-trash-alt" style="color:rgb(255, 255, 255); position:absolute; margin-left:-26px; margin-top:8px;"></i>
                            </div>
                            @csrf
                            @method('DELETE')
                        </form>
                </td>
            </tr>
            @endforeach
          </tbody>
         
        </table>

    </div>
</div>


@endsection