@extends('layouts.admin')

@section('content-header')
<section class="content-header">
  <h1>
    Service | Home
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Service</li>
    <li class="active">Add Service</li>
  </ol>
</section>
@endsection

@section('content')
<div class="col-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Add Service</h3>
        </div>
        <form action="{{ route('admin.service.create') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="box-body">

                <div class="form-group">
                    <label for="name" >Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') ? old('name') : '' }}">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="short_description" >Short Description</label>
                    <input type="text" name="short_description" class="form-control" value="{{ old('short_description') ? old('short_description') : '' }}">
                    @error('short_description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description') ? old('description') : '' }}</textarea>
                    @error('description')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image">Service image</label>
                    <div class="slim" data-label="Click or Drop your image here" data-force-size="215,215" data-ratio="1:1" data-max-file-size="1" data-will-crop-initial="determineInitialCropRect" style="max-width:215px;max-height:215px;">
                        <input type="file" name="image[]" id="image" accept="image/jpeg,image/png,image/gif, image/jpg">  
                    </div>

                    @error('image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="box-footer">
                <input type="submit" class="btn btn-primary" value="Submit" name="addPost" id="addPost">
            </div>    
        </form>
    </div>    
</div> 

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('backend/css/slim.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('backend/js/slim.kickstart.min.js') }}" ></script>
<script>
    function determineInitialCropRect(file, done) {
        var rect = {
            x: 0,
            y: 0,
            width: 215,
            height: 215
        };
        done(rect);
    }
</script>
@endpush

