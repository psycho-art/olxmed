@extends('layouts.admin')

@section('content-header')
<section class="content-header">
  <h1>
    Preferences | Settings
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Preferences</li>
    <li class="active">Setting</li>
  </ol>
</section>
@endsection

@section('content')

@inject('preferences', 'App\Http\Controllers\Admin\PreferenceController')

<div class="col-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Setting</h3>
        </div>
        <form class="ad-form" action="{{ route('admin.preferences.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="margin-bottom: 1em" class="from-group">
                <label>This image will appear on your webiste header</label>
                <div class="slim" data-label="Webiste Header image" data-max-file-size="1"  data-will-crop-initial="determineInitialCropRect" style="max-width:215px;max-height:215px;">
                    <input type="file" name="header_image" id="image" accept="image/jpeg,image/png,image/gif, image/jpg">  
                    <?php $header_image = $preferences::getPref('header_image'); ?>
                    @if ($header_image)
                        <img src="{{ asset('storage/'.$header_image) }}" alt="Header image" />
                    @endif 

                    @error('header_image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <?php $twitter_link = $preferences::getPref('twitter_link'); ?>
                <label for="twiiter_link">Twitter link (Leave empty if none)</label>
                <input type="text" name="twitter_link" class="form-control" value="{{ $twitter_link ? $twitter_link : '' }}">
            </div>

            <div class="form-group">
                <?php $facebook_link = $preferences::getPref('facebook_link'); ?>
                <label for="facebook_link">Facebook link (Leave empty if none)</label>
                <input type="text" name="facebook_link" class="form-control" value="{{ $facebook_link ? $facebook_link : '' }}">
            </div>

            <div class="form-group">
                <?php $instagram_link = $preferences::getPref('instagram_link'); ?>
                <label for="instagram_link">Instagram link (Leave empty if none)</label>
                <input type="text" name="instagram_link" class="form-control" value="{{ $instagram_link ? $instagram_link : '' }}">
            </div>

            <div class="form-group">
                <?php $email = $preferences::getPref('email'); ?>
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control" value="{{ $email ? $email : '' }}">
            </div>

            <div class="form-group">
                <?php $number = $preferences::getPref('number'); ?>
                <label for="number">Number</label>
                <input type="text" name="number" class="form-control" value="{{ $number ? $number : '' }}">
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
<link href="{{ asset('backend/summernote.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('backend/js/slim.kickstart.min.js') }}" ></script>
<script src="{{ asset('backend/js/slim.multiple.js') }}" ></script>
<script src="{{ asset('backend/summernote.min.js') }}"></script>
<script>
    $(function() {
        $('.editor').summernote({
            placeholder: "Write content.....",
            tabsize: 2,
            height: 300
        });
    });

    // function determineInitialCropRect(file, done) {
    //     var rect = {
    //         x: 0,
    //         y: 0,
    //         width: 200,
    //         height: 200
    //     };
    //     done(rect);
    // }

</script>
@endpush

