<header class="header">
    <div class="middle header__middle bg--header__middle pt-35 pb-35">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content--header__middle d-flex align-items-center justify-content-between">
                        @inject('preferences', 'App\Http\Controllers\PreferencesController')
                        <div class="logo--header__middle">
                            <div class="logo">
                                <?php $header_image = $preferences::getPref('header_image'); ?>
                                <a class="logo__link" href="{{ route('home') }}"><img src="{{ asset('storage/'.$header_image) }}" alt=""></a>
                            </div>
                        </div>
                        <div class="search--header__middle h1search--header__middle">
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
                        <div class="cart--header__middle d-none d-md-block">
                            <div class="cart--header__list">
                                <ul class="list-inline">
                                    <li><a href="{{ route('user.registerForm') }}"><i class="fal fa-user-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom header__bottom header__bottom--border custom-header-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-8 col-md-7 col-2">
                    <div class="main-menu">
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
                <div class="col-12">
                    <div class="mobile-menu"></div>
                </div>
            </div>
        </div>
    </div>
</header>