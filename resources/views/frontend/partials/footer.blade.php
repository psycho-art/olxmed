<footer class="footer--area">
    <div class="footer--top pt-70 pb-25">
        @inject('preferences', 'App\Http\Controllers\PreferencesController')
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-8 mb-30">
                    <div class="footer-widget">
                        <div class="footer-title">
                            <h6 class="f-800">Contact Information</h6>
                        </div>
                        <div class="contacts-address">
                            <div class="contacts-icon">
                                <i class="icofont-headphone-alt-3"></i>
                            </div>
                            <div class="contacts-address--text">
                                <?php $number = $preferences::getPref('number'); ?>
                                <span>Got Questions? Call Us 24/7</span>
                                <h5 class="f-800">{{ $number ? $number : '' }}</h5>
                            </div>
                        </div>
                        <div class="contacts-address--footer">
                            <?php $email = $preferences::getPref('email'); ?>
                            <p><a href="mailto:{{ $email ? $email : '' }}">{{ $email ? $email : '' }}</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-8 mb-30 order-md-3 order-lg-2">
                    <div class="footer-widget">
                        <div class="footer-title">
                            <h6 class="f-800">Get to Know Us</h6>
                        </div>
                        @php    
                            $pages = \DB::table('pages')->where('place', 'header')->orWhere('place', 'both')->get();
                        @endphp
                        @if (!$pages->isEmpty())
                            <div class="footer-menu">
                                <ul>
                                    @foreach ($pages as $page)
                                        <li><a href="{{ route('page', $page->slug) }}">{{ $page->title }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-xl-2 mb-30 col-lg-6 col-md-4 order-md-2 order-lg-3 col-sm-6">
                    <div class="footer-widget">
                        <div class="footer-title">
                            <h6 class="f-800">Get to Know Us</h6>
                        </div>
                        <?php 
                            $facebook_link = $preferences::getPref('facebook_link'); 
                            $instagram_link = $preferences::getPref('instagram_link'); 
                            $twitter_link = $preferences::getPref('twitter_link'); 
                        ?>
                        <div class="footer-menu h1foote-menu2">
                            <ul>
                                @if ($facebook_link)
                                    <li><a href="{{ $facebook_link }}">Facebook</a></li>
                                @endif
                                @if ($twitter_link)
                                    <li><a href="{{ $twitter_link }}">Twitter</a></li>
                                @endif
                                @if ($instagram_link)
                                    <li><a href="{{ $instagram_link }}">Instagram</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-6 col-md-4 mb-30 order-md-4 order-lg-4 col-sm-6">
                    <div class="footer-widget">
                        <div class="footer-title">
                            <h6 class="f-800">Let Us Help You</h6>
                        </div>
                        <div class="footer-menu h1foote-menu2">
                            <ul>
                                <li><a href="{{ route('user.registerForm') }}">Your Account</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom gray-bg pt-20 pb-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="footer-copyright">
                        <p class="m-0">Copyright {{ Date('Y') }} {{ $homeSeo->title }} All Rights Reserved.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="footer-payment--sponsors text-right">
                        <a href="#" class="payment-images"><img src="img/payment/payment-thumb.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>