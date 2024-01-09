@extends('layouts.app-master')

@section('content')
    <div class="branch">
        <div class="container">
        <h5 class="title-branch">Export Import Users</h5>
        <hr class="border"></hr>
		<div class="table-body">
            <h5 class="list-branch">User List</h5>
	    <!-- <a href="{{ route('perusahaan.create') }}" class="btn btn-sm btn-add mb-3"><i class="fas fa-plus"></i> Add Company</a>-->


            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <input type="file" name="file" class="form-control">

                <br>

                <button class="btn btn-success">Import User Data</button>

            </form>
	    <table class="table table-responsive data-table">
               <tr>

                    <th colspan="3">

                        List Of Users

                        <a class="btn btn-warning float-end" href="{{ route('export') }}">Export User Data</a>

                    </th>

                </tr>

                <tr>

                    <th>ID</th>

                    <th>Name</th>

                    <th>Email</th>

                </tr>

                @foreach($users as $user)

                <tr>

                    <td>{{ $user->id }}</td>

                    <td>{{ $user->name }}</td>

                    <td>{{ $user->email }}</td>

                </tr>

                @endforeach                
                
            </table>
        </div>
    </div>
    </div>
    

@endsection
