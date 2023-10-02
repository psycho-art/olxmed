@extends('frontend.partials.main')

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
            <section class="blog-area-three blog-page pb-25 pt-80">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-sm-12 order-2 order-lg-1">
                            <div class="common-sidebar">
                                <div class="search-field">
                                    <form action="{{ route('blog.search') }}" method="get">
                                        <input type="text" value="{{ $keywords }}" name="keywords" placeholder="Search for Blog...">
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
                        <div class="col-lg-9 col-sm-12 order-1 order-lg-2">
                            <div class="row small-padding">
                                @foreach ($blog as $item)
                                    @php $blogImages = \DB::table('blog_images')->where('post_id', $item->id)->first(); @endphp
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="blog-single mb-60">
                                            <div class="image">
                                                <a href="{{ route('blog.detail', $item->slug) }}"><img style="width: 90%; height: 200px;" src="{{ asset('storage/'.$blogImages->image) }}" class="img-fluid" alt=""></a>
                                            </div>
                                            <div class="content">
                                                <span class="dusty__gray-color f-400 pt-15"{{ date('d M Y', strtotime($item->created_at)) }}</span>
                                                <span class="blog-title"><a href="#" class="cod__black-color f-700">{{ $item->title }}</a></span>
                                                <p class="f-400">{{ $item->short_description }}</p>
                                                <a href="{{ route('blog.detail', $item->slug) }}" class="f-600 grenadier-color">Read More <i class="icofont-long-arrow-right grenadier-color"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- blog area end -->

    </main>
        <!-- Main End -->
@endsection