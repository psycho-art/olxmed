@extends('layouts.admin')

@section('content-header')
<section class="content-header">
  <h1>
    Product | Add Category
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Blog</li>
    <li>All Categories</li>
    <li class="active">Add Category</li>
  </ol>
</section>
@endsection

@section('content')
<div class="col-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Add Category</h3>
        </div>
        <form action="{{ route('admin.blog.category.store') }}" method="POST">
            @csrf

            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-5">    
                        <div class="form-group">
                            <label for="name" >Category Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <a href="{{ route('admin.blog.category.index') }}" class="btn btn-danger">Cancel</a>
                <input type="submit" class="btn btn-primary" value="Submit" name="addPost" id="addPost">
            </div>    
        </form>
    </div>    
</div> 

@endsection