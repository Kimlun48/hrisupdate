@extends('layouts.app-master')

@section('content')

<div class="create-user">
<div class="container">
        <h5 class="title-create-user">Add new user</h5>
            
        <hr class="border"></hr>
		<div class="table-body">
            <h5 class="list-create-user"> Add new user and assign role.</h5>
            <form method="POST" action="">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="{{ old('name') }}" 
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
                    <input value="{{ old('email') }}"
                        type="email" 
                        class="form-control" 
                        name="email" 
                        placeholder="Email address" required>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input value="{{ old('password') }}"
                        type="password" 
                        class="form-control" 
                        name="password" 
                        placeholder="Password" required>
                    @if ($errors->has('password'))
                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input value="{{ old('confirm_password') }}"
                        type="password" 
                        class="form-control" 
                        name="confirm_password" 
                        placeholder="Confirm Password" required>
                    @if ($errors->has('confirm_password'))
                        <span class="text-danger text-left">{{ $errors->first('confirm_password') }}</span>
                    @endif
                </div>                

                <div class="buton-action" style="">
                <a href="{{ URL::previous() }}" class="btn btn-sm btn-back">Back</a>
                <button type="reset" class="btn btn-sm btn-cancel">Cancel</button>
                <button type="submit" class="btn btn-sm btn-save">Save</button>
                </div>

                <!-- <button type="submit" class="btn btn-sm btn-primary">Save user</button>
                <button type="reset" class="btn btn-sm btn-warning">Reset</button>
                <a href="{{ route('users.index') }}" class="btn btn-sm btn-default">Back</a> -->
            </form>

        </div>
        </div>
    </div>

@endsection