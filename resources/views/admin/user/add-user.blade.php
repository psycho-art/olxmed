@extends('layouts.admin')

@section('content-header')
<section class="content-header">
  <h1>
    Users | Add User
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Users</li>
    <li class="active">Add User</li>
  </ol>
</section>
@endsection

@section('content')
<div class="col-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Add User</h3>
        </div>
        <form action="{{ route('admin.storeNewUser') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-5">    
                        <div class="form-group">
                            <label for="name" >Name</label>
                            <input type="text" name="username" class="form-control" value="{{ old('username') }}" placeholder="Enter Name">
                            @error('username')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="cnic" >CNIC ( Without Hyphen(-) )</label>
                            <input type="number" name="cnic" class="form-control custom-number" placeholder="Enter CNIC ( Without Hyphen(-) )" value="{{ old('cnic') }}">
                            @error('cnic')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" >Email</label>
                            <input type="text" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter Email">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="role" >Role</label>
                            <select name="role" class="form-control" >
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>

                            @error('role')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="pass-container" style="display: flex; align-items: flex-end;">
                                <div style="width: 100%; margin-right: 1em;">
                                    <label for="password" >Password</label>
                                    <input type="text" id="password" name="password" value="{{ old('password') }}" placeholder="Enter Password" class="form-control">
                                </div>
                                <div>
                                    <input type="button" class="btn btn-success" name="generate" id="generate" value="Generate">
                                </div>
                            </div>

                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
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

            $("#generate").click(function() {
                var randomstring = Math.random().toString(36).substr(2, 8);
                $("#password").val(randomstring);
            });
        });
    </script>
@endpush


