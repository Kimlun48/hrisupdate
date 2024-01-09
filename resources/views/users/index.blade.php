@extends('layouts.app-master')
@section('content')

<div class="users">
    <h5 class="title-users">Users</h5>
    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>  
    <hr class="border"></hr>
    <div class="table-body">
        <h5 class="list-users">Manage Users here.</h5>
        <a href="{{ route('users.create') }}" class="btn btn-sm btn-add mb-3"><i class="fas fa-plus"></i> Add user</a>			
        <table class="table data-table">
        <thead>
            <tr class="judul">
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th width="20%">Action</th>
            </tr>
        </thead>
        <tbody class="data-table isi">
        </tbody>
    </table>
    <!-- datatable -->
    <script src="https://code.jquery.com/jquery.js" defer></script>
    <script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js" defer> </script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" defer></script>  

    <script>
    $(function () {
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('users.index') !!}', //{!! route('users.index') !!}
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]});
    });
    </script>    
    </div>
</div>

@endsection