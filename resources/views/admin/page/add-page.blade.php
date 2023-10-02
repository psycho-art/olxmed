@extends('layouts.admin')

@section('content-header')
<section class="content-header">
  <h1>
    Pages | Add Page
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Page</li>
    <li class="active">New Page</li>
  </ol>
</section>
@endsection

@section('content')
<div class="col-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Add Page</h3>
        </div>
        <form action="{{ route('admin.page.store') }}" method="post">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label for="title">Page Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Your page title" value="{{ old('title') }}" autofocus >
                    @error('title')
                        <small class="text-danger">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="keywords">Meta Keywords</label>
                    <input type="text" name="keywords" id="keywords" class="form-control" placeholder="Your meta keywords for this page" value="{{ old('keywords') }}" >
                    @error('keywords')
                        <small class="text-danger">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Meta Description</label>
                    <textarea rows="3" name="description" id="description" class="form-control" placeholder="Your meta description for this page" >{{ old('description') }}</textarea>
                    @error('description')
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

                <div class="form-group">
                    <label style="display: block;">Link of this page</label>
                    <label class="radio-inline">
                        <input type="radio" name="place" id="locked_yes" value="header" {{ old('header') == 'yes' ? 'checked' : '' }}> Header
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="place" id="locked_no" value="footer" {{ old('footer') == 'no' ? 'checked' : '' }}> Footer
                    </label>

                    <label class="radio-inline">
                        <input type="radio" name="place" id="locked_no" value="both" {{ old('footer') == 'no' ? 'checked' : '' }}> Both
                    </label>

                    @error('place')
                        <small class="text-danger" style="display: block;">
                            <strong>{{ $message }}</strong>
                        </small>
                    @enderror
                </div>

                <div class="form-group">
                    <label style="display: block;">Locked</label>
                    <label class="radio-inline">
                        <input type="radio" name="locked" id="locked_yes" value="yes" {{ old('locked') == 'yes' ? 'checked' : '' }}> Yes
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="locked" id="locked_no" value="no" {{ old('locked') == 'no' ? 'checked' : '' }}> No
                    </label>
                    @error('locked')
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
    <style>
        .text-danger {
            font-size: 1.1em;
        }
    </style>
@endpush

@push('scripts')
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