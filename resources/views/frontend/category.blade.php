@extends('frontend.partials.main')

@section('seo')
    <title>{{ $category->name.' - '.$homeSeo->title }}</title>
    <meta property="og:title" content="{{ $category->name }}">
    <meta content="{{ $category->name }}" name="description">
    <meta content="{{ $category->name }}" name="keywords">
    <meta property="og:description" content="{{ $category->name }}">
@endsection

@section('content')
    <main class="main--wrapper">

        <!-- shop area start -->
        <div class="product shop-page pt-80 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 order-2 order-lg-1">
                        <div class="common-sidebar shop-banner-sidebar">
                            <div class="common-cat">
                                <div class="side-title">
                                    <h6>Categories</h6>
                                </div>
                                <ul>
                                    <li><a href="#">Accessories Part<span>+</span></a></li>
                                    <li><a href="#">Appiliances<span>+</span></a></li>
                                    <li><a href="#">Clothing<span>+</span></a></li>
                                    <li><a href="#">Categoried</a></li>
                                    <li><a href="#">Indoor Plants</a></li>
                                    <li><a href="#">Sweaters<span>+</span></a></li>
                                    <li><a href="#">Accessories<span>+</span></a></li>
                                    <li><a href="#">Electronic Drone</a></li>
                                    <li><a href="#">Mattrress<span>+</span></a></li>
                                    <li><a href="#">Computer & PC<span>+</span></a></li>
                                    <li><a href="#">View More<span>+</span></a></li>
                                </ul>
                            </div>
                            <div class="slider-range mt-50">
                                <div class="side-title mb-30">
                                    <h6>Filter By Price</h6>
                                </div>
                                <div id="slider-range"></div>
                                <p>
                                    <label for="amount">Price :</label>
                                    <input type="text" id="amount" readonly>
                                </p>
                            </div>
                            <div class="side-color mt-45">
                                <div class="side-title">
                                    <h6>Color</h6>
                                </div>
                                <ul class="mt-15">
                                    <li>
                                        <a href="#">Blue (2)</a>
                                        <a href="#">White (53)</a>
                                    </li>
                                    <li>
                                        <a href="#">Pink (20)</a>
                                        <a href="#">Brown (16)</a>
                                    </li>
                                    <li>
                                        <a href="#">Green (2)</a>
                                        <a href="#">Yellow (53)</a>
                                    </li>
                                    <li><a href="#">Red (20)</a></li>
                                </ul>
                            </div>
                            <div class="side-size mt-50">
                                <div class="side-title">
                                    <h6>Size</h6>
                                </div>
                                <ul class="mt-15">
                                    <li>
                                        <a href="#">Small (2)</a>
                                        <a href="#">Large (53)</a>
                                    </li>
                                    <li>
                                        <a href="#">Extra Large (16)</a>
                                        <a href="#">Medium (20)</a>
                                    </li>
                                    <li><a href="#">Extra Small (2)</a></li>
                                    <li><a href="#">Huge (53)</a></li>
                                </ul>
                            </div>
                            <div class="common-tag mt-50">
                                <div class="side-title">
                                    <h6>Popular Tag</h6>
                                </div>
                                <ul class="mt-25 mb-15">
                                    <li><a href="#">Small</a></li>
                                    <li><a href="#">Fashion</a></li>
                                    <li><a href="#">Grey</a></li>
                                    <li><a href="#">Yellows</a></li>
                                    <li><a href="#">Magenta</a></li>
                                    <li><a href="#">Clothing</a></li>
                                    <li><a href="#">Small</a></li>
                                    <li><a href="#">Fashion</a></li>
                                    <li><a href="#">Grey</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 order-1 order-lg-2">
                        <div class="border-b">
                            <div class="row">
                                <div class="col-lg-5 col-md-4">
                                    <div class="shop-bar d-flex align-items-center">
                                        <h4 class="f-800 cod__black-color">Home</h4>
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}.</li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-8">
                                    <div class="bar-wrapper">
                                        <div class="select-text">
                                            <span>{{ $products->total() }} results</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-30">
                            {{-- <div class="col-sm-12"> --}}

                                @foreach ($products as $item)

                                

                                    @php 
                                        $productImage = \DB::table('product_images')->where('product_id', $item->id)->first(); 
                                        $category = \DB::table('categories')->where('id', $item->category_id)->first();
                                        $city = \DB::table('cities')->where('id', $item->city_id)->first();
                                        $date = \Carbon\Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans();

                                        $string = substr($item->neighbourhood, 0, 12).", ".$city->name." • ".$date;
                                    @endphp
                                    <div class="col-lg-3 col-md-4">
                                        <div class="product__single">
                                            <div class="product__box">
                                                <div class="product__thumb">
                                                    <a href="{{ route('product-detail', $item->slug."_".$item->id) }}" class="img-wrapper">
                                                        <img class="img" style="min-height: 100px; width: 100%;" src="{{ asset('storage/'.$productImage->image) }}" alt="">
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
                                            </div>
                                            <div class="product-action">
                                                <div class="location">
                                                    <span style="color: #72878A; font-size: 0.8em;">{!! (strlen($string) > 30) ? substr($string, 0, 30).'...' : $string !!}</span>
                                                </div>
                                            </div>
                                        
                                        </div>
                                    </div>
                                @endforeach
                            {{-- </div> --}}
                        </div>
                        <div class="row mt-10">
                            <div class="col-sm-12">
                                <div class="common-pagination">
                                    {!! $products->links('pagination::bootstrap-4') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- shop area end -->

    </main>
@endsection