@extends('frontend.partials.main')

@section('seo')
    @php $getCategory = \DB::table('blog_categories')->where('id', $post->category_id)->first(); @endphp

    <title>{{ $post->title.' - '.$homeSeo->title }}</title>
    <meta property="og:title" content="{{ $post->title }}">
    <meta content="{{ $post->meta_description }}" name="description">
    <meta content="{{ $post->meta_keywords }}" name="keywords">
    <meta property="og:description" content="{{ $post->meta_description }}">
@endsection

@section('content')
    <!-- Main -->
    <main class="main--wrapper">

        <!-- page banner area start -->
            <section class="page-banner-area blog-page mt-25" data-background="img/bg/blog-page-banner.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="banner-text text-center pt-50 pb-45">
                                <h2 class="f-800 cod__black-color">The Blogs</h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Blog.</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- page banner area end -->

            <!-- blog area start -->
            <section class="blog-details-area pb-80 pt-80">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="main-wrapper">
                                <div class="blog-details-img-active">
                                    @foreach ($postImages as $item)
                                        <div class="single-img">
                                            <img style="width: 100%; height: 470px;" src="{{ asset('storage/'.$item->image) }}" class="img-fluid" alt="">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="content-wrapper">
                                    <div class="date">
                                        <h2>{{ date('d', strtotime($post->created_at)) }}</h2>
                                        <span>{{ date('M, Y', strtotime($post->created_at)) }}</span>
                                    </div>
                                    <div class="text">
                                        <h4>{{ $post->title }}</h4>
                                        @php 
                                        $postedBy = \DB::table('admins')->where('id', 1)->first();
                                        $cat = \DB::table('blog_categories')->where('id', $post->category_id)->first();
                                        @endphp
                                        <ul class="mb-35 mt-15">
                                            <li><a href="#"><span class="lnr lnr-user"></span>By {{ ucfirst($postedBy->name )}}</a></li>
                                            {{-- <li><a href="#"><span class="lnr lnr-bubble"></span>3 comments</a></li> --}}
                                            <li><a href="#"><span class="lnr lnr-bookmark"></span>{{ $cat->name }}</a></li>
                                        </ul>
                                        <p class="f-400 mb-20">{!! $post->content !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="common-sidebar">
                                <div class="search-field">
                                    <form action="{{ route('blog.search') }}" method="get">
                                        <input type="text" value="" name="keywords" placeholder="Search for Blog...">
                                        <button type="submit"><i class="icofont-search-1"></i></button>
                                    </form>
                                </div>
                                <div class="common-cat">
                                <div class="side-title mt-40">
                                        <h6>Categories</h6>
                                    </div>
                                    <ul>
                                        @foreach ($blogCategories as $item)
                                            @php $count = \DB::table('blog')->where('category_id', $item->id)->count(); @endphp
                                            <li><a href="#">{{ $item->name }}<span>{{ $count }}</span></a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- blog area end -->

    </main>
        <!-- Main End -->
@endsection