@extends('frontend.partials.main')

@section('seo')
    <title>{{ $page->title.' - '.$homeSeo->title }}</title>
    <meta property="og:title" content="{{ $page->title }}">
    <meta content="{{ $page->description }}" name="description">
    <meta content="{{ $page->keywords }}" name="keywords">
    <meta property="og:description" content="{{ $page->description }}">
@endsection

@section('content')
    <!-- Main -->
    <main class="main--wrapper">

        <!-- page banner area start -->
            @if ($banner)
                <section class="page-banner-area blog-page mt-25" data-background="{{ asset('storage/'.$banner->image) }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="banner-text text-center pt-50 pb-45">
                                    @if ($banner->text)
                                        <div class="ck-content">
                                            {!! $banner->text !!}
                                        </div>
                                    @endif
                                    <h2 class="f-800 cod__black-color">{{ $page->title }}</h2>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">{{ $page->title }}</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @else
                <!-- page banner area start -->
                <section class="page-banner-area" data-background="img/bg/page-banner.jpg">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 offset-lg-2 col-sm-12">
                                <div class="banner-text text-center pt-90 pb-25">
                                    <h2 class="f-800 cod__black-color">{{ $page->title }}</h2>
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">{{ $page->title }}</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- page banner area end -->
            @endif
            <!-- page banner area end -->

            <!-- blog area start -->
            <section class="pb-80 pt-80">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            {!! $page->content !!}
                        </div>
                    </div>
                </div>
            </section>
            <!-- blog area end -->

    </main>
        <!-- Main End -->
@endsection