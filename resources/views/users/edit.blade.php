@extends('layouts.app-master')

@section('content')

<div class="users-edit">
<div class="container">
    <h5 class="title-users-edit">Update user</h5>
    <hr class="border"></hr>
    <div class="table-body">
        <h5 class="list-users-edit">Update Users here.</h5>
        <form method="post" action="{{ route('users.update', $user->id) }}">
                @method('patch')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="{{ $user->name }}" 
                        type="text" 
                        class="form-control" 
                        name="name" 
                        placeholder="Name" required>

                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input value="{{ $user->email }}"
                        type="email" 
                        class="form-control" 
                        name="email" 
                        placeholder="Email address" required>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="role" class="form-label">Auth Group</label>
                    <select class="form-control" 
                        name="role" required>
                        <option value="">Select role</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ in_array($role->name, $userRole) 
                                    ? 'selected'
                                    : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('role'))
                        <span class="text-danger text-left">{{ $errors->first('role') }}</span>
                    @endif
                </div>



                <div class="mb-3">

                    <label for="role" class="form-label"  data-toggle="tooltip" data-placement="top" title="Default Password : Qwerty123#">Reset Passoword</label>
                    <select class="form-control" name="resetpass" required>
                        <option value="No">No</option>
                        <option value="Yes">Yes</option>
                    </select>
                    @if ($errors->has('resetpass'))
                        <span class="text-danger text-left">{{ $errors->first('resetpass') }}</span>
                    @endif
                </div>


                <div class="mb-3">

                    <label for="aktif" class="form-label" >Active User</label>
                    <select class="form-control" name="aktif" required>
                        <option value="No">No</option>
                        <option value="Aktif">Aktif</option>
                    </select>
                    @if ($errors->has('aktif'))
                        <span class="text-danger text-left">{{ $errors->first('aktif') }}</span>
                    @endif

                </div>

                <div class="buton-action" style="">
                <a href="{{ route('users.index') }}" class="btn btn-sm btn-back">Back</a>
                <button type="submit" class="btn btn-sm btn-save">Update</button>
                </div>
            </form>
    </div>
</div>
</div>


@endsection
