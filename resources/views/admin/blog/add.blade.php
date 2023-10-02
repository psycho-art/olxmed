@extends('layouts.admin')

@section('content-header')
<section class="content-header">
  <h1>
    Blog | Add Post
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Blog</li>
    <li class="active">Add Post</li>
  </ol>
</section>
@endsection

@section('content')
<div class="col-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Add Post</h3>
        </div>
        <form action="{{ route('admin.blog.store') }}" method="post">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <div class="file-drop-area">
                        <label for="files" class="d-block drop-area text-center rounded p-4">Click or Drop your Post images here</label>
                        <input data-max-file-size="1" name="post_images[]" id="files" type="file" multiple>
                    </div>
                    @error('post_images')
                        <small class="text-danger" style="display: block;">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                    <div class="card-columns" id="gallery_area"></div>
                </div> 

                <div class="form-group">
                    <label for="category">Choose Category</label>
                    <select name="category" id="category" class="form-control">
                        <option value="">Choose Category</option>
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>

                    @error('category')
                        <small class="text-danger">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="meta_keywords">Meta Keywords</label>
                    <input type="text" name="meta_keywords" id="meta_keywords" class="form-control" placeholder="Your meta keywords for this page" value="{{ old('meta_keywords') }}">
                    @error('meta_keywords')
                        <small class="text-danger">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <textarea rows="3" name="meta_description" id="meta_description" class="form-control" placeholder="Your meta description for this page">{{ old('meta_description') }}</textarea>
                    @error('meta_description')
                        <small class="text-danger">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Your title" value="{{ old('title') }}">
                    @error('title')
                        <small class="text-danger">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="short_description">Short Description</label>
                    <textarea rows="3" name="short_description" id="short_description" class="form-control" placeholder="Your short description for this post">{{ old('short_description') }}</textarea>
                    @error('short_description')
                        <small class="text-danger">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea id="content" class="form-control editor" name="content">{{ old('content') }}</textarea>
                    @error('content')
                        <small class="text-danger">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
    
                {{-- @if (!empty($slider_imgs))
                    @foreach ($slider_imgs as $img)
                        <div class="form-group">
                            <img style="width: 30%" src="{{ asset('storage'.'/'.$img->value) }}">
                            <div>
                                <a href="{{ route('admin.deleteImage', ['id' => $img->id]) }}" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    @endforeach
                @endif --}}

                <div class="form-group">
                    <label style="display: block;">Status</label>
                    <select name="status" class="form-control">
                        <option value="publish">Publish</option>
                        <option value="draft">Draft</option>
                    </select>
                    @error('status')
                        <small class="text-danger" style="display: block;">
                            <strong>{{ $message }}</strong>
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
</style>
@endpush

@push('scripts')
<script src="{{ asset('backend/js/slim.kickstart.min.js') }}" ></script>
<script src="{{ asset('backend/js/slim.multiple.js') }}" ></script>
<script src="{{ asset('backend/editor/ckeditor5/build/ckeditor.js') }}"></script>
<script src="{{ asset('backend/editor/ckfinder/ckfinder.js') }}"></script>
<script>
    $(function() {
        ClassicEditor
			.create( document.querySelector( '#content' ), {

				ckfinder: {
					uploadUrl: '<?php echo asset('backend/editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'); ?>',
				},	
				image: {
					// Configure the available styles.
					styles: [
						'alignLeft', 'alignCenter', 'alignRight'
					],

					toolbar: [
						'imageStyle:alignLeft', 'imageStyle:alignCenter', 'imageStyle:alignRight',
						'|',
						'resizeImage',
						'|',
						'imageTextAlternative'
					]
				},
				toolbar: {
					items: [
						'heading',
						'|',
						'fontFamily',
						'fontSize',
						'bold',
						'italic',
						'link',
						'bulletedList',
						'numberedList',
						'horizontalLine',
						'|',
						'alignment',
						'outdent',
						'indent',
						'|',
						'imageUpload',
						'blockQuote',
						'insertTable',
						'mediaEmbed',
						'undo',
						'redo',
						'CKFinder'
					]

				
				},
				styles: [
                'full',
                'side'
            	],
				width: 'auto',
				language: 'en',
				licenseKey: '',
				
				
				
			} )
			.then( editor => {
				window.editor = editor;
		
				
				
				
			} )
			.catch( error => {
				console.error( 'Oops, something went wrong!' );
				console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
				console.warn( 'Build id: jpvg7aux1x3g-jqmc0ujm22r5' );
				console.error( error );
			} );
    });

</script>
@endpush