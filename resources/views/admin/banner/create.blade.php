@extends('layouts.admin')

@section('content-header')
<section class="content-header">
  <h1>
    Banners | Add Banner
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Banners</li>
    <li class="active">Add Banner</li>
  </ol>
</section>
@endsection

@section('content')
<div class="col-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Add Banner</h3>
        </div>
        <form action="{{ route('admin.banner.store') }}" enctype="multipart/form-data" method="post" id="addProductForm">
            @csrf
            <div class="box-body">

                {{-- <div class="form-group first_cat common">
                    <label class="choose_category" for="choose_category">Choose Category</label>
                    <select data-index="0" name="category_id[0]" id="category_id" class="form-control category_id">
                        <option value="">Choose Category</option>
                        @foreach ($category as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div> --}}
                <div class="form-group">
                    <label for="pagee">Select Page</label>
                    <select name="page" id="page" class="form-control">
                        <option value="">Select page</option>
                        <option value="home">Home</option>
                        <option value="blog" >Blog</option>
                        @foreach ($pages as $item)
                            <option value="{{ $item->title }}">{{ $item->title }}</option>
                        @endforeach
                    </select>
                    @error('page')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="file-drop-area">
                        <label for="files" class="d-block drop-area text-center rounded p-4">Click or Drop your Banner here</label>
                        <input data-max-file-size="1" name="banner_image" id="files" type="file">
                    </div>
                    @error('banner_image')
                        <small class="text-danger" style="display: block;">
                            {{ $message }}
                        </small>
                    @enderror
                    <div class="card-columns" id="gallery_area"></div>
                </div> 

                <div class="form-group" id="slideshow" style="display: none; justify-content: space-between; align-items: center;">
                    <label for="slideshow">Show in slideshow</label>
                    <div>
                        <label class="switch">
                            <input name="slideshow" type="checkbox">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label style="display: block;">Status</label>
                    <select name="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    @error('status')
                        <small class="text-danger" style="display: block;">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection
@push('styles')
<link rel="stylesheet" href="{{ asset('backend/css/slim.min.css') }}">
<style>
    .text-danger {
        font-size: 1.1em;
    }
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input { 
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    label.error {
        color: red;
        font-weight: normal;
    }
    #radioBtn .notActive{
        color: #3276b1;
        background-color: #fff;
    }

    #condition-error {
        display: block;
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('backend/js/slim.kickstart.min.js') }}" ></script>
<script src="{{ asset('backend/js/slim.custom.multiple.js') }}" ></script>
<script src="{{ asset('backend/editor/ckeditor5/build/ckeditor.js') }}"></script>
<script src="{{ asset('backend/editor/ckfinder/ckfinder.js') }}"></script>
<script>
    $(function() {

        $("#price").on('keyup', function() {
            var val = $(this).val();
            val = val.replace(/,/g, '');
            console.log(val);
            var formatted = val.replace(/\d+/g, n => Number(n).toLocaleString("en-IN"))
            // console.log(val.toLocaleString('en-IN'));
            // if(formatted) 
            // console.log(formatted);
            console.log(formatted);
                $(this).val(formatted);

            
        })

        $("#page").on('change', function() {
            var val = $(this).val();
            if(val == 'home') {
                $("#slideshow").css('display', 'flex');
            } else {
                $("#slideshow").prop('checked', 'false')
                $("#slideshow").css('display', 'none');
            }
        })

    });

</script>
@endpush