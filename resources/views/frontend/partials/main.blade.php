@extends('layouts.frontend')

@section('wrapper')
    @include('frontend.partials.header')
    
    @yield('content')

    @include('frontend.partials.footer')
@endsection