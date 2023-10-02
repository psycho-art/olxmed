<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.webmanifest">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('frontend/css/meanmenu.css')}}">
    <link rel="stylesheet" href="{{ asset("frontend/css/style.css") }}">
    <link rel="stylesheet" href="{{ asset("frontend/css/responsive.css") }}">
    <link rel="stylesheet" href="{{ asset("frontend/css/ckeditor.css") }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/fontaweasome-all.min.css') }}">

    @yield('seo')

    <meta property="og:image" content="{{ $homeSeo->image ? asset('storage/'.$homeSeo->image) : '' }}">

    @yield('css')
</head>

<body>

    @yield('wrapper')





    <!-- JS here -->
    {{-- <script src="https://use.fontawesome.com/70d973bc3c.js"></script> --}}
    <script src="{{ asset('frontend/js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/js/one-page-nav-min.js') }}"></script>
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/js/ajax-form.js') }}"></script>
    <script src="{{ asset('frontend/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('frontend/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/select2.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-ui-slider-range.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.elevateZoom-3.0.8.min.js') }}"></script>
    <script src="{{ asset('frontend/js/meanmenu.min.js') }}"></script>
    <script src="{{ asset('frontend/js/Elemental.js') }}"></script>
    <script src="{{ asset('frontend/js/plugins.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    @yield('js')
</body>

</html>