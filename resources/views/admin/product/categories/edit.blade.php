@extends('layouts.admin')

@section('content-header')
<section class="content-header">
  <h1>
    Product | Edit Category
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Blog</li>
    <li>All Categories</li>
    <li class="active">Edit Category</li>
  </ol>
</section>
@endsection

@section('content')
<div class="col-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Category</h3>
        </div>
        <form action="{{ route('admin.product.category.update', $data->id) }}" method="POST">
            @csrf

            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-5">  
                        <div class="form-group">
                            <label for="parent_id">Choose Parent Category</label>
                            <select name="parent_id" id="parent_id" class="form-control">
                                <option value="">Choose Category</option>
                                @foreach ($categories as $item)
                                    <option {{ $data->parent_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                                <option {{ $data->parent_id == 0 ? 'selected' : '' }} value="0">None</option>
                            </select>

                            @error('parent_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>  
                        <div class="form-group">
                            <label for="name" >Category Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') ? old('name') : $data->name }}">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="icon" >Icon</label>
                            <input type="text" name="icon" class="form-control" value="{{ old('icon') ? old('icon') : $data->icon }}">
                            @error('icon')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <a href="{{ route('admin.product.category.index') }}" class="btn btn-danger">Cancel</a>
                <input type="submit" class="btn btn-primary" value="Submit" name="addPost" id="addPost">
            </div>    
        </form>
    </div>    
</div> 

@endsection