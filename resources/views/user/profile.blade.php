@extends('layouts.user')

@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/css/slim.min.css') }}">
@endpush

@section('content-header')
<section class="content-header">
  <h1>
    Edit Profile
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('user.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Edit Profile</li>
  </ol>
</section>
@endsection

@section('content')
<div class="col-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Update Information</h3>
        </div>
        <form action="{{ route('user.profile.update') }}" method="POST">
            @csrf

            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-3 col-sm-push-6 col-md-push-6">
                        <div class="form-group">
                            <label for="image">Click to upload image</label>
                            <div class="slim" data-label="Click or Drop your image here" data-force-size="215,215" data-ratio="1:1" data-max-file-size="1" data-will-crop-initial="determineInitialCropRect" style="max-width:215px;max-height:215px;">
                                <input type="file" name="image[]" id="image" accept="image/jpeg,image/png,image/gif, image/jpg">  
                                @if (isset($user->image))
                                    <img src="{{ asset('storage/'.$user->image) }}" alt="{{ $user->name }}" />
                                @endif
                            </div>

                            @error('image')
                                <small class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-5 col-sm-pull-4 col-md-pull-3">    
                        <div class="form-group">
                            <label for="name" >Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                            @error('name')
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
<script src="{{ asset('backend/js/slim.kickstart.min.js') }}" ></script>
    <script>
        $(function() {
            const password = $('#password');

            $('#togglePassword').click(function() {
                const type = password.attr('type') == 'password' ? 'text' : 'password';
                password.attr('type', type);

                $(this).toggleClass('fa-eye-slash')
            })

            function determineInitialCropRect(file, done) {
                var rect = {
                    x: 0,
                    y: 0,
                    width: 215,
                    height: 215
                };
                done(rect);
            }
        });
    </script>
@endpush


