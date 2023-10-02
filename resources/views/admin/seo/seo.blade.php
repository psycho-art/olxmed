@extends('layouts.admin')

@section('content-header')
<section class="content-header">
  <h1>
    SEO | Home
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>SEO</li>
    <li class="active">{{ Request::segment(3) }}</li>
  </ol>
</section>
@endsection

@section('content')
<div class="col-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{{ $seo->name }}</h3>
        </div>
        <form action="{{ route('admin.seo.store', ['name' => $seo->name]) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="box-body">
                <div class="row">
                    @if (Request::segment(3) == 'home')
                    <div class="col-xs-12 col-sm-4 col-md-6 col-sm-push-6 col-md-push-5">
                        <div class="form-group">
                            <label for="image">This image will appear when sharing website on social media</label>
                            <div class="slim" data-label="Click or Drop your avatar here" data-force-size="215,215" data-ratio="1:1" data-max-file-size="1" data-will-crop-initial="determineInitialCropRect" style="max-width:215px;max-height:215px;">
                                <input type="file" name="image[]" id="image" accept="image/jpeg,image/png,image/gif, image/jpg">  
                                @if ($seo->image != '')
                                    <img src="{{ asset('storage/'.$seo->image) }}" alt="{{ $seo->name }}" />
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-4 col-sm-pull-4 col-md-pull-6">    
                        <div class="form-group">
                            <label for="title" >Meta Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $seo->title ? $seo->title : '' }}">
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="keywords" >Meta Keywords</label>
                            <input type="text" name="keywords" class="form-control" value="{{ $seo->keywords ? $seo->keywords : '' }}">
                            @error('keywords')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="keywords" >Meta Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ $seo->description ? $seo->description : '' }}</textarea>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    @else 
                    <div class="col-xs-12 col-sm-6 col-md-5">    
                        <div class="form-group">
                            <label for="title" >Meta Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $seo->title ? $seo->title : '' }}">
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="keywords" >Meta Keywords</label>
                            <input type="text" name="keywords" class="form-control" value="{{ $seo->keywords ? $seo->keywords : '' }}">
                            @error('keywords')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description" >Meta Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ $seo->description ? $seo->description : '' }}</textarea>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    @endif
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

