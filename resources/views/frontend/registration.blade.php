@extends('frontend.partials.main')

@section('seo')
    @php 
        $seo = \DB::table('seo')->where('name', 'login-register')->first();
    @endphp


    <title>{{ $seo->title ? $seo->title.' - '.$homeSeo->title : '' }}</title>
    <meta property="og:title" content="{{ $seo->title ? $seo->title : '' }}">
    <meta content="{{ $seo->description }}" name="description">
    <meta content="{{ $seo->keywords }}" name="keywords">
    <meta property="og:description" content="{{ $seo->description }}">
@endsection

@section('css')
    <style>
        .field input {
            margin-bottom: 0 !important;
        }

        .field {
            margin-bottom: 30px;
        }
    </style>
@endsection

@section('content')
    <main class="main--wrapper">

        <!-- page banner area start -->
        <section class="page-banner-area" data-background="img/bg/page-banner.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 col-sm-12">
                        <div class="banner-text text-center pt-90 pb-25">
                            <h2 class="f-800 cod__black-color">Register</h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Register</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page banner area end -->

        <!-- reg area start -->
        <section class="reg-area pt-60 pb-75">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <div class="reg-wrapper">
                            <ul class="nav" id="myTab" role="tablist">
                                <li class="nav-item ml-40">
                                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Registration</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <form action="register" method="POST">
                                        @csrf
                                        <div class="field">
                                            <label>Username</label>
                                            <input type="text" name="username" value="{{ old('username') }}" placeholder="Username" >

                                            @error('username')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="field">
                                            <label>Email</label>
                                            <input type="text" name="email" value="{{ old('email') }}" placeholder="Email Address" >

                                            @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="field">
                                            <label>Password</label>
                                            <input type="password" name="password" placeholder="Password" >

                                            @error('password')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="field">
                                            <label>Confirm Password</label>
                                            <input type="password" name="password_confirmation" placeholder="Confirm Password" >
                                        </div>
                                        <button type="submit">Register</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- reg area end -->

    </main>    
@endsection