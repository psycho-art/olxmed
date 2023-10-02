<!DOCTYPE html>
<html>
    <head>
        <title>{{ $title }}</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="{{ URL::asset('backend/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ URL::asset('backend/css/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ URL::asset('backend/css/ionicons.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ URL::asset('backend/css/AdminLTE.min.css') }}">
        <!-- AdminLTE Skins -->
        <link rel="stylesheet" href="{{ URL::asset('backend/css/skin-blue.min.css') }}">
        <!-- custom styleseet -->
        <link rel="stylesheet" href="{{ URL::asset('backend/css/styles.css') }}">
      
        @stack('styles')
        
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        @include('admin.common.admin-header')

        @include('admin.common.admin-nav')
        <div class="wrapper">

            <div class="content-wrapper">
                @yield('content-header')

                <section class="content">
                    @yield('content')
                </section>
            </div>
            


            @include('admin.common.admin-footer')
            <!-- jQuery 2.2.3 -->
            <script src="{{ URL::asset('backend/js/jquery-3.1.1.min.js') }}"></script>
            <!-- Bootstrap 3.3.6 -->
            <script src="{{ URL::asset('backend/js/bootstrap.min.js') }}"></script>
            <!-- Slimscroll -->
            <script src="{{  URL::asset('backend/js/jquery.slimscroll.min.js') }}"></script>
            <!-- AdminLTE App -->
            <script src="{{ URL::asset('backend/js/app.min.js') }}"></script>

            <script src="{{ asset('backend/js/bootstrap-notify.min.js') }}"></script>

            @include('layouts.notify')

            @stack('scripts')
        </div> 
    </body>
    
</html>    