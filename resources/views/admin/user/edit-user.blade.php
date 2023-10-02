@extends('layouts.admin')

@section('content-header')
<section class="content-header">
  <h1>
    Users | Edit User
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Users</li>
    <li class="active">Edit User</li>
  </ol>
</section>
@endsection

@section('content')
<div class="col-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Edit User</h3>
        </div>
        <form action="{{ route('admin.updateUser', ['id' => $user->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-5">    
                        <div class="form-group">
                            <label for="username" >Name</label>
                            <input type="text" name="username" class="form-control" value="{{ $user->username }}">
                            @error('username')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" >Email</label>
                            <input type="text" name="email" class="form-control" value="{{ $user->email }}">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" >Password</label>
                            <div class="input-group" id="show_hide_password">
                                <input class="form-control" type="password" id="password" name="password">
                                <div class="input-group-addon">
                                  <a class="showHide" href="#"><i class="fa fa-eye" aria-hidden="true" id="togglePassword"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="location" >Role</label>
                            <select name="role" id="role" class="form-control" >
                                <option {{ $user->role == 'admin' ? 'selected' : '' }} value="admin">Admin</option>
                                <option {{ $user->role == 'user' ? 'selected' : '' }} value="user">User</option>
                            </select>
            
                            @error('location')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-check">
                            <label class="form-check-label" style="display: flex;">
                              <input style="margin-right: 0.3em;" type="checkbox" {{ $user->blocked == 'yes' ? 'checked' : '' }} value='yes' class="form-check-input" name="blocked">Block this user
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <input type="submit" class="btn btn-primary" value="Submit" name="addPost" id="addPost">
            </div>    
        </form>
    </div>    
</div> 

@endsection
@push('scripts')
    <script>
        $(function() {
            const password = $('#password');

            $('#togglePassword').click(function() {
                const type = password.attr('type') == 'password' ? 'text' : 'password';
                password.attr('type', type);

                $(this).toggleClass('fa-eye-slash')
            })
        });
    </script>
@endpush

