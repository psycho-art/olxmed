<header class="header">
    {{-- <div class="top header__top gray-bg d-none d-md-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-5">
                    <div class="message--header__top">
                        <p class="message m-0 dove__gray-color">Free Shipping Worldwide - On All Order Over $1000</p>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7">
                    <div class="menu--header__top text-right">
                        <nav class="nav--top__list">
                            <ul class="list-inline">
                                <li><a class="nav--top__link dove__gray-color text-capitalize position-relative" href="#">store Locator</a></li>
                                <li><a class="nav--top__link dove__gray-color text-capitalize position-relative" href="#">Track Orders</a></li>
                                <li><a class="nav--top__link dove__gray-color text-capitalize position-relative" href="#">Credit Card</a></li>
                                <li class="nav--top__dropdown position-relative"><a class="nav--top__link lang--top__link dove__gray-color text-capitalize position-relative" href="#">English & Dollar<span class="lnr lnr-chevron-down"></span></a>
                                    <ul class="dropdown-show">
                                        <li><a class="dove__gray-color text-capitalize" href="#"><span class="lang">canada</span><span class="currency">USD</span></a></li>
                                        <li><a class="dove__gray-color text-capitalize" href="#"><span class="lang">Bangladesh</span><span class="currency">TAKA</span></a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="middle header__middle bg--header__middle pt-35 pb-35 header-middle-two">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-2 col-md-4">
                    @inject('preferences', 'App\Http\Controllers\PreferencesController')
                    <div class="logo">
                        <?php $header_image = $preferences::getPref('header_image'); ?>
                        <a class="logo__link" href="{{ route('home') }}"><img src="{{ asset('storage/'.$header_image) }}" alt=""></a>
                    </div>
                </div>
                <div class="col-xl-6 d-none d-xl-block">
                    <div class="main-menu main-menu2">
                        <nav id="mobile-menu">
                            <ul>
                                <li>
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="mega-menu static dropdown-icon">
                                    <a href="#">Shop</a>
                                    <ul class="submenu mega-full">
                                        @foreach ($categories as $item)
                                            <li>
                                                <a href="{{ route('category', $item->slug) }}">{{ $item->name }}</a>
                                                @php $childCat = \DB::table('categories')->where('parent_id', $item->id)->orderBy('name')->get(); @endphp
                                                @if (!$childCat->isEmpty())
                                                    <ul class="submenu  level-1">
                                                        @foreach ($childCat as $c)
                                                            <li>
                                                                <a href="{{ route('category', $c->slug) }}">{{ $c->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>        
                                        @endforeach
                                    </ul>
                                </li>
                                @php    
                                    $pages = \DB::table('pages')->where('place', 'header')->orWhere('place', 'both')->get();
                                @endphp
                                @foreach ($pages as $page)
                                    <li>
                                        <a href="{{ route('page', $page->slug) }}">{{ ucfirst($page->title) }}</a>
                                    </li>
                                @endforeach
                                <li>
                                    <a href="{{ route('blog') }}">Blog</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-xl-4 col-md-8">
                    @inject('preferences', 'App\Http\Controllers\PreferencesController')
                    <div class="user-access2">
                        <ul class="list-inline">
                            <li>
                                <div class="user-access--box">
                                    <div class="user-access--icon">
                                        <span class="lnr lnr-phone-handset"></span>
                                    </div>
                                    <div class="user-access--content">
                                        <?php $number = $preferences::getPref('number'); ?>
                                        <h5>Support</h5>
                                        <span>{{ $number ? $number : '' }}</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="user-access--box">
                                    <div class="user-access--icon">
                                        <span class="lnr lnr-user"></span>
                                    </div>
                                    <div class="user-access--content">
                                        <h5>Account</h5>
                                        <a href="{{ route('user.loginForm') }}">Login </a> / <a href="{{ route('user.registerForm') }}">Register</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom header__bottom grenadier-bg">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-5 col-10">
                    <div class="dept__menu position-relative">
                        <nav>
                            <ul class="dept__menu--list dept__menu--list2">
                                <li><a class="dept__menu-mlink dept__menu-mlink2 f-900 cod__gray-color" href="#">Shop By Categories</a>
                                    <ul class="dept__menu--dropdown open">
                                        @foreach ($categories as $item)
                                            @php $getChild = \DB::table('categories')->where('parent_id', $item->id)->get(); @endphp
                                            @if (!$getChild->isEmpty()) 
                                                <li class="dropdown"><a class="dept__menu--dlink" href="{{ route('category', $item->slug) }}">{{ $item->name }}</a>
                                                    <ul class="sub__menu sub__dept--menu">
                                                        @foreach ($getChild as $item1)
                                                            @php $getChildChild = \DB::table('categories')->where('parent_id', $item1->id)->get(); @endphp
                                                            @if (!$getChildChild->isEmpty())
                                                                <li class="dropdown"><a href="{{ route('category', $item1->slug) }}">{{ $item1->name }}</a>
                                                                    <ul class="sub__menu level2">
                                                                        @foreach ($getChildChild as $item2)
                                                                            <li><a href="{{ route('category', $item2->slug) }}">{{ $item2->name }}</a></li>
                                                                        @endforeach
                                                                    </ul>
                                                                </li>
                                                            @else
                                                                <li><a href="{{ route('category', $item1->slug) }}">{{ $item1->name }}</a></li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @else
                                                <li><a class="dept__menu--dlink" href="{{ route('category', $item->slug) }}">{{ $item->name }}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 col-md-7 col-2 d-flex align-items-center">
                    <div class="search--header__middle h2search--header__middle d-none d-lg-block">
                        <form class="search--header__form position-relative" action="{{ route('search') }}" method="get">
                            <div class="header--search__cate">
                                <select name="city" id="header--search__main">
                                    <option value="">Location</option>
                                    @foreach ($cities as $item)
                                        {{-- @if ($childCat) --}}
                                            {{-- <optgroup label="{{ ucfirst($item->name) }}"> --}}
                                                <option @php if(isset($city_id)) { if($city_id == $item->id) { echo 'selected'; } } @endphp value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                                            {{-- </optgroup> --}}
                                        {{-- @endif --}}
                                    @endforeach
                                </select>
                            </div>
                            <div class="header--search__box">
                                <input class="header--search__query" name="keywords" value="{{ isset($keywords) ? $keywords : '' }}" type="text" placeholder="Search For Products...">
                                <button class="header--search__btn"><i class="icofont-search-2"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mobile-menu"></div>
                </div>
            </div>
        </div>
    </div>
</header>

