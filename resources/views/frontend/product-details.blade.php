@extends('frontend.partials.main')

@section('seo')
    @php 
        $getCategory = \DB::table('categories')->where('id', $product->category_id)->first(); 
        $productDescription = strip_tags($product->description);
    @endphp

    <title>{{ $product->title.' - '.$homeSeo->title }}</title>
    <meta property="og:title" content="{{ $product->name }}">
    <meta content="{!! substr($productDescription, 0, 200) !!}" name="description">
    <meta content="{{ $product->title }}, {{ $getCategory->name }}" name="keywords">
    <meta property="og:description" content="{!! substr($productDescription, 0, 200) !!}">
@endsection

@section('css')
<style>
    .cart-wrapper {
        background-color: #f9f9f9;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .cart-title {
        margin-bottom: 20px;
    }

    .profileImage img {
        object-fit: cover;
        border-radius: 50%;
        height: 80px;
        width: 80px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    }

    .profile-info {
        display: flex;
        align-items: center;
    }

    .profile-info h2 {
        font-size: 1.5rem;
        color: #333;
        margin-left: 10px;
        margin-bottom: 5px;
    }

    .profile-info span {
        margin-left: 10px;
        margin-bottom: 5px;
        white-space: nowrap;
    }

    .profile-info span {
        font-size: 0.9rem;
        color: #888;
    }

    .price {
        border-bottom: 1px solid #ccc;
        margin-bottom: 20px;
    }

    .price h3 {
        font-size: 1.8rem;
        color: #333;
        font-weight: bold;
    }

    .location h3 {
        font-size: 1.2rem;
        color: #333;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .location h4 {
        font-size: 1.1rem;
        color: #888;
        margin-bottom: 0;
    }
</style>

@endsection

@section('content')
        <!-- Main -->
        <main class="main--wrapper">


        <!-- Shop-details start -->
        <section class="shop-details-area pb-80">
            <div class="container">
               <div class="row">
                   <div class="col-sm-12">
                       <div class="shop-bred pt-35 pb-35">
                            <nav aria-label="breadcrumb">
                               <ol class="breadcrumb">
                                   <li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
                                   <li class="breadcrumb-item"><a href="index-2.html">Phones & Tablet</a></li>
                                   <li class="breadcrumb-item"><a href="index-2.html">Headphone</a></li>
                                   <li class="breadcrumb-item active" aria-current="page">Ultra Wireless 550 Headphone With Bluetooth.</li>
                               </ol>
                           </nav>
                        </div>
                   </div>
               </div>
                <div class="row">
                    <div class="col-lg-5 col-md-6 order-1 order-lg-1">
                        <div class="pro-img">
                            <div class="tab-content" id="myTabContent">
                                @php $i = 0; @endphp
                                @foreach ($prodImages as $prodImage)
                                    <div class="tab-pane fade {{ $i == 0 ? 'show active' : '' }}" id="home{{ $i }}" role="tabpanel" aria-labelledby="home-tab5">
                                        <img src="{{ asset('storage/'.$prodImage->image) }}" class="img-fluid" alt="">
                                    </div>
                                    @php $i++; @endphp
                                @endforeach
                            </div>
                            <ul class="nav" id="myTab1" role="tablist">
                                @php $i = 0; @endphp
                                @foreach ($prodImages as $prodImage)
                                    <li class="nav-item">
                                        <a class="nav-link {{ $i == 0 ? 'active' : '' }}" id="home-tab{{ $i }}" data-toggle="tab" href="#home{{ $i }}" role="tab" aria-controls="home5" aria-selected="true">
                                            <img src="{{ asset('productThumbs'.'/'.$prodImage->thumbnail) }}" class="img-fluid" alt="">
                                        </a>
                                    </li>
                                    @php $i++; @endphp
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 order-3 order-lg-2">
                        <div class="pro-content">
                            @php 
                                $getCategory = \DB::table('categories')->where('id', $product->category_id)->first();
                            @endphp
                            <span>{{ $getCategory->name }}</span>
                            <h5 class="title">{{ $product->title }}</h5>

                            <h3 class="title">Rs {{ $product->price }}</h3>
                            <div class="about-pro">
                                <div class="ck-content">
                                    {!! $product->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 order-2 order-lg-3">
                        @php 
                            $city = \DB::table('cities')->where('id', $product->city_id)->first();

                            if($product->posted_by == 'admin') {
                                $user = \DB::table('admins')->where('id', $product->user_id)->first();
                            } else {
                                $user = \DB::table('users')->where('id', $product->user_id)->first();
                            }
                        @endphp
                    <div class="cart-wrapper">
                        <div class="cart-title">
                            <div class="profile-info">
                                <div class="profileImage">
                                    @if ($user->image)
                                        <img class="img-fluid" src="{{ asset('storage/'.$user->image) }}" alt="Profile Image">
                                    @else
                                        <img src="{{ asset('noProfile.png') }}" alt="Profile Placeholder">
                                    @endif
                                </div>
                                <div class="profile-details">
                                    <h2>{{ $user->name }}</h2>
                                    <span>Member since {{ date('M Y', strtotime($user->created_at)) }}</span>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="price">
                            <h3>Rs {{ $product->price }}</h3>
                        </div> --}}
                    </div>

<div class="cart-wrapper" style="margin-top: 2em;">
    {{-- <div class="price">
        <h3>Rs {{ $product->price }}</h3>
    </div> --}}
    <div class="location">
        <h3>Location</h3>
        <h4 style="display: flex; align-items: center;"><svg style="margin-right: 0.2em;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 1024 1024" class="cc9ef69b"><path d="M512 85.33c211.75 0 384 172.27 384 384 0 200.58-214.8 392.34-312.66 469.34H440.68C342.83 861.67 128 669.9 128 469.33c0-211.73 172.27-384 384-384zm0 85.34c-164.67 0-298.67 133.97-298.67 298.66 0 160.02 196.89 340.53 298.46 416.6 74.81-56.72 298.88-241.32 298.88-416.6 0-164.69-133.98-298.66-298.67-298.66zm0 127.99c94.1 0 170.67 76.56 170.67 170.67s-76.56 170.66-170.66 170.66-170.67-76.56-170.67-170.66S417.9 298.66 512 298.66zm0 85.33c-47.06 0-85.33 38.28-85.33 85.34s38.27 85.33 85.34 85.33 85.33-38.27 85.33-85.33-38.27-85.34-85.33-85.34z"></path></svg> {{ $product->neighbourhood }}, {{ $city->name }}</h4>
    </div>
</div>

                    </div>
                </div>
            </div>
        </section>
        <!-- Shop-details end -->

            <section class="shop-details-desc">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="desc-wrapper">
                                <ul class="nav custom-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab11" data-toggle="tab" href="#home11" role="tab" aria-controls="home11" aria-selected="true">Additional Information</a>
                                    </li>
                                    {{-- <li class="nav-item">
                                        <a class="nav-link active" id="profile-tab11" data-toggle="tab" href="#profile11" role="tab" aria-controls="profile11" aria-selected="false">Description </a>
                                    </li> --}}
                                </ul>
                                <div class="tab-content" id="myTabContent1">
                                    <div class="tab-pane fade show active" id="home11" role="tabpanel" aria-labelledby="home-tab11">
                                        <div class="desc-content mt-60">
                                            <div class="row">
                                                <div class="col-md-12 mb-30">
                                                    <div class="spe-wrapper">
                                                        <ul>
                                                            <li>Price</li>
                                                            <li>{{ $product->price }}</li>
                                                            <li>Location</li>
                                                            <li>{{ $product->neighbourhood." ,".$city->name }}</li>
                                                            <li>Posted</li>
                                                            <li>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($product->created_at))->diffForHumans() }}</li>
                                                            <li>Number</li>
                                                            <li>{{ $product->number }}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="tab-pane fade show active" id="profile11" role="tabpanel" aria-labelledby="profile-tab11">
                                        <div class="desc-content mt-60">
                                            {!! $product->description !!}
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Shop-details end -->
    
            <!-- Product  -->
            @if (!$relatedProducts->isEmpty())
                <div class="product pt-75 product-h-two">
                    <div class="container">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-sm-12">
                                <div class="section-header">
                                    <div class="row align-items-center">
                                        <div class="col-xl-9 col-sm-6">
                                            <div class="product-section2">
                                                <h6 class="product--section__title2"><span>Related Products</span></h6>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6">
                                            {{-- <div class="all__product--link text-right">
                                                <a class="all-link" href="shop-collection.html">Discover All Products<span
                                                        class="lnr lnr-arrow-right"></span></a>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                                {{-- <div class="product__active owl-carousel"> --}}
                                @foreach ($relatedProducts as $item)
                                @php 
                                    $productImage = \DB::table('product_images')->where('product_id', $item->id)->first(); 
                                    $category = \DB::table('categories')->where('id', $item->category_id)->first();
                                    $city = \DB::table('cities')->where('id', $item->city_id)->first();
                                    $date = \Carbon\Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans();
        
                                    $string = substr($item->neighbourhood, 0, 30).", ".$city->name." • ".$date
                                
                                @endphp
                                    <div class="col-lg-3 col-md-4">
                                        <div class="product__single">
                                            <div class="product__box">
                                                <div class="product__content--top">
                                                    <span class="cate-name">{{ $category->name }}</span>
                                                    <h6 class="product__title mine__shaft-color f-700 mb-0"><a href="{{ route('product-detail', $item->slug."_".$item->id) }}">{{ $item->title }}</a></h6>
                                                </div>
                                                <div class="product__thumb">
                                                    <a href="{{ route('product-detail', $item->slug."_".$item->id) }}" class="img-wrapper">
                                                        <img class="img" src="{{ asset('storage/'.$productImage->image) }}" alt="">
                                                    </a>
                                                </div>
                                                <div class="product__content--rating d-flex justify-content-between">
                                                    <div class="price">
                                                        <h5 class="grenadier-color f-600">PKR {{ $item->price }}</h5>
                                                    </div>
                                                </div>
                                                <div class="location" style="text-overflow: ellipsis; text-overflow: hidden; white-space: nowrap;">
                                                    <span style="color: #72878A; font-size: 0.8em;">{!! (strlen($string) > 50) ? substr($string, 0, 50).'...' : $string !!}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                {{-- </div> --}}
                        </div>
                    </div>
                </div>
            @endif
                <!-- Product end -->
    
        </main>
        <!-- Main End -->
@endsection
