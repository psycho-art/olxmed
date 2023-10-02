@extends('frontend.partials.main')

@section('seo')
    <title>{{ $homeSeo ? $homeSeo->title : '' }}</title>
    <meta property="og:title" content="{{ $homeSeo ? $homeSeo->title : '' }}">
    <meta content="{{ $homeSeo ? $homeSeo->description : '' }}" name="description">
    <meta content="{{ $homeSeo ? $homeSeo->keywords : '' }}" name="keywords">
    <meta property="og:description" content="{{ $homeSeo ? $homeSeo->description : '' }}">
@endsection

@section('content')
<main class="main--wrapper">

    <!-- hero  -->
    @if (!$banners->isEmpty())
        <section class="hero hero__area hero-two pt-20">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="hero__active slider-active">
                            @foreach ($bannersSlide as $banner)
                                <div class="single__hero single-slider hero__bg pt-140 pb-160" data-background="{{ asset('storage/'.$banner->image) }}">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-12">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-3 d-none d-lg-block">
                        @foreach ($banners as $item)
                        <div class="hero__offer--box mb-20">
                            <img src="{{ asset('storage/'.$item->image) }}" alt="" class="hero__offer--thumb img">
                            <div class="hero__offer--content">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- hero end -->

    <!-- Categories Slider -->
    <section class="categories-slider pt-50">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="categories-slider--active owl-carousel">
                        @php $i = 0; @endphp
                        @foreach ($categories as $item)
                            <div class="single-categories">
                                <div class="icon @php if($i % 2 == 0) { echo "gray-bg-icon"; } else { echo "gray-orange-bg"; } @endphp">
                                    {!! $item->icon !!}
                                </div>
                                <h6><a href="{{ route('category', $item->slug) }}">{{ $item->name }}</a></h6>
                            </div>
                            @php $i++; @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Slider End -->

    <!-- Product  -->
    @if (!$featuredProducts->isEmpty())
        <div class="product pt-50 feature-h-one">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-9 col-sm-6">
                        <div class="product-section mb-30">
                            <h6 class="product--section__title f-800 white-color grenadier-bg">Featured Products</h6>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 mb-20">
                        <div class="product__active owl-carousel">
                            @foreach ($featuredProducts as $item)
                            @php 
                                $productImage = \DB::table('product_images')->where('product_id', $item->id)->first(); 
                                $category = \DB::table('categories')->where('id', $item->category_id)->first();
                                $city = \DB::table('cities')->where('id', $item->city_id)->first();
                                $date = \Carbon\Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans();
    
                                $string = substr($item->neighbourhood, 0, 30).", ".$city->name." • ".$date
                            
                            @endphp
                                <div class="product__single">
                                    <div class="product__box">
                                        <div class="product__thumb">
                                            <a href="{{ route('product-detail', $item->slug."_".$item->id) }}" class="img-wrapper">
                                                <img class="img" src="{{ asset('storage/'.$productImage->image) }}" alt="">
                                                {{-- <img class="img secondary-img" src="{{ asset('storage/'.$productImage->image) }}" alt=""> --}}
                                            </a>
                                        </div>
                                        <div class="product__content--top">
                                            <span class="cate-name">{{ $category->name }}</span>
                                            <h6 class="product__title mine__shaft-color f-700 mb-0"><a href="{{ route('product-detail', $item->slug."_".$item->id) }}">{{ $item->title }}</a></h6>
                                        </div>
                                        <div class="product__content--rating d-flex justify-content-between">

                                            <div class="price">
                                                <h5 class="grenadier-color f-600">Rs {{ $item->price }}</h5>
                                            </div>
                                        </div>
                                        <div class="location" style="text-overflow: ellipsis; text-overflow: hidden; white-space: nowrap;">
                                            <span style="color: #72878A; font-size: 0.8em;">{!! (strlen($string) > 50) ? substr($string, 0, 50).'...' : $string !!}</span>
                                        </div>
                                    </div>
                                
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Product end -->

    @if (!$products->isEmpty())
        <div class="product pt-50 feature-h-one">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-9 col-sm-6">
                        <div class="product-section mb-30">
                            <h6 class="product--section__title f-800 white-color grenadier-bg">Fresh Products</h6>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 mb-20">
                        <div class="product__active owl-carousel">
                            @foreach ($products as $item)
                            @php 
                                $productImage = \DB::table('product_images')->where('product_id', $item->id)->first(); 
                                $category = \DB::table('categories')->where('id', $item->category_id)->first();
                                $city = \DB::table('cities')->where('id', $item->city_id)->first();
                                $date = \Carbon\Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans();
    
                                $string = substr($item->neighbourhood, 0, 30).", ".$city->name." • ".$date
                            
                            @endphp
                                <div class="product__single">
                                    <div class="product__box">
                                        <div class="product__thumb">
                                            <a href="{{ route('product-detail', $item->slug."_".$item->id) }}" class="img-wrapper">
                                                <img class="img" src="{{ asset('storage/'.$productImage->image) }}" alt="">
                                                {{-- <img class="img secondary-img" src="{{ asset('storage/'.$productImage->image) }}" alt=""> --}}
                                            </a>
                                        </div>
                                        <div class="product__content--top">
                                            <span class="cate-name">{{ $category->name }}</span>
                                            <h6 class="product__title mine__shaft-color f-700 mb-0"><a href="{{ route('product-detail', $item->slug."_".$item->id) }}">{{ $item->title }}</a></h6>
                                        </div>
                                        <div class="product__content--rating d-flex justify-content-between">

                                            <div class="price">
                                                <h5 class="grenadier-color f-600">Rs {{ $item->price }}</h5>
                                            </div>
                                        </div>
                                        <div class="location" style="text-overflow: ellipsis; text-overflow: hidden; white-space: nowrap;">
                                            <span style="color: #72878A; font-size: 0.8em;">{!! (strlen($string) > 50) ? substr($string, 0, 50).'...' : $string !!}</span>
                                        </div>
                                    </div>
                                
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- modal area start --
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
        Launch demo modal
    </button>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <div class="modal-wrapper">
                       <div class="pro-img">
                           <img src="img/allproducts/modal-img.jpg" data-zoom-image="img/allproducts/demo.jpg" class="zoom-e-img" alt="">
                       </div>
                       <div class="pro-text">
                           <h4>-30% on Subscribe</h4>
                           <p>Five things you only know if you were at Chanel
                               Hamburg Show Kering Reinforces Luxury Status
                               By Distributing Puma.</p>
                            <form action="#">
                                <input type="email" placeholder="Enter your Email">
                                <button type="submit">Submit</button>
                                <span>
                                    <input type="checkbox">
                                    Prevent this pop-up
                                </span>
                            </form>
                       </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
    -- modal area end -->

</main>
@endsection