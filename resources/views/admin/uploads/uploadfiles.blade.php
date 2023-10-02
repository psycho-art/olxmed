@extends('layouts.admin')

@section('content-header')
<section class="content-header">
  <h1>
    Files | Upload File
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Files</li>
    <li class="active">Upload FIles</li>
  </ol>
</section>
@endsection

@section('content')
<div class="col-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Upload Files</h3>
        </div>
        <form class="ad-form" action="{{ route('admin.uploadFiles') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title" >Title</label>
                <input type="text" name="title" placeholder="TITLE" value="{{ old('title') }}" class="form-control ad_input">

                @error('title')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="cat_name">Select Category</label>
                <select name="cat_name" class="form-control ad_input">
                    @foreach ($cat as $c)
                        <option value="{{ $c->id }}"> {{ $c->name }} </option>
                    @endforeach
                </select>

                @error('cat_name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="user">Select User</label>
                <select name="user" class="form-control ad_input">
                    <option value=""> none </option>
                    @foreach ($user as $u)
                        <option value="{{ $u->id }}"> {{ $u->username }} </option>
                    @endforeach
                </select>

                @error('user')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <div class="file-drop-area">
                    <label for="files" class="d-block drop-area text-center rounded p-4">Click or Drop your Files here</label>
                    <input name="files[]" id="files" type="file" multiple>
                </div>
                @error('files')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="card-columns" id="gallery_area"></div>
            </div>    

            {{-- <div class="form-group"> --}}
                <input type="submit" class="btn btn-primary" value="Submit" name="addPost" id="addPost">
            {{-- </div>     --}}
        </form>
    </div>    
</div> 

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('backend/css/slim.min.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('backend/js/slim.kickstart.min.js') }}" ></script>
<script src="{{ asset('backend/js/slim.multiple.js') }}" ></script>
@endpush

