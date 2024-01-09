@extends('layouts.app-master')

@section('content')
<div class="users-show">
    <h5 class="title-users-show">Show user</h5>
    <hr class="border"></hr>
    <div class="table-body">
        <h5 class="list-users-show"></h5>
            <div>
                Name: {{ $user->name }}
            </div>
            <div>
                Email: {{ $user->email }}
            </div>
            <div>
                Username: {{ $user->username }}
            </div>

            <div class="buton-action" style="">
                <a href="{{ URL::previous() }}" class="btn btn-sm btn-back">Back</a>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-edit">Edit</a>
                </div>
            </div>
</div>

  
@endsection