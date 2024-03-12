<div class="footer">
    <div class="footer-top">
        <div class="container-fluid">
            <div class="row px-2 px-md-4 py-md-3">

                <div class="col-lg-4 col-md-3 mr-0">
                    <!--<a href="/" class="d-block">-->
                    @if(get_setting('footer_logo') != null)
                    <img class="lazyload" src="{{ uploaded_asset(get_setting('footer_logo')) }}" alt="{{ env('APP_NAME') }}" height="auto" width="400">
                    @else
                    <img class="lazyload" src="{{ static_asset('assets/img/logo.png') }}" width="400" alt="{{ env('APP_NAME') }}" height="auto">
                    @endif
                    <!--</a>-->
                </div>
                <div class="col-lg-3 col-md-2 mr-0">
                    <div class="text-center text-md-left mt-4">
                        <h4 class="fs-13 text-uppercase fw-600 pb-2 mb-4">
                            {{ translate('ABOUT') }}
                        </h4>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a class="opacity-50 hov-opacity-100 text-reset" href="{{ url('/about-us') }}">{{ translate('About us') }}</a>
                            </li>
                            <li class="mb-2">
                                <a class="opacity-50 hov-opacity-100 text-reset" href="{{ url('/contact-us') }}">{{ translate('Contact us') }}</a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-2 mr-0">
                    <div class="text-center text-md-left mt-4">
                        <h4 class="fs-13 text-uppercase fw-600  pb-2 mb-4">
                            {{ translate('Information') }}
                        </h4>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a class="opacity-50 hov-opacity-100 text-reset" href="{{ url('/terms-conditions') }}">
                                    {{ translate('Terms of Use') }}
                                </a>
                            </li>
                            <li class="mb-2">
                                <a class="opacity-50 hov-opacity-100 text-reset" href="{{ url('/privacy-policy') }}">
                                    Privacy Policy
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>



                <div class="col-md-2 col-lg-2">
                    <div class="text-center text-md-left mt-4">
                        <h4 class="fs-13 text-uppercase fw-600  pb-2 mb-4">
                            {{ translate('My Account') }}
                        </h4>
                        <ul class="list-unstyled">
                            @if (Auth::check())
                            <li class="mb-2">
                                <a class="opacity-50 hov-opacity-100 text-reset" href="{{ route('logout') }}">
                                    {{ translate('Logout') }}
                                </a>
                            </li>
                            @else
                            <li class="mb-2">
                                <a class="opacity-50 hov-opacity-100 text-reset" href="{{ route('user.login') }}">
                                    {{ translate('Login') }}
                                </a>
                            </li>
                            @endif
                            <li class="mb-2">
                                <a class="opacity-50 hov-opacity-100 text-reset" href="{{ route('wishlists.index') }}">
                                    {{ translate('My Wishlist') }}
                                </a>
                            </li>
                            <!-- <li class="mb-2">
                            <a class="opacity-50 hov-opacity-100 text-reset" href="{{ route('purchase_history.index') }}">
                                {{ translate('Order History') }}
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="opacity-50 hov-opacity-100 text-reset" href="{{ route('wishlists.index') }}">
                                {{ translate('My Wishlist') }}
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class="opacity-50 hov-opacity-100 text-reset" href="{{ route('orders.track') }}">
                                {{ translate('Track Order') }}
                            </a>
                        </li> -->
                            @if (addon_is_activated('affiliate_system'))
                            <!-- <li class="mb-2">
                                <a class="opacity-50 hov-opacity-100 text-light-footer" href="{{ route('affiliate.apply') }}">{{ translate('Be an affiliate partner')}}</a>
                            </li> -->
                            @endif
                        </ul>
                    </div>
                    @if (get_setting('vendor_system_activation') == 1)
                    <!-- <div class="text-center text-md-left mt-4">
                        <h4 class="fs-13 text-uppercase fw-600 border-bottom border-gray-900 pb-2 mb-4">
                            {{ translate('Be a Seller') }}
                        </h4>
                        <a href="{{ route('shops.create') }}" class="btn btn-primary btn-sm shadow-md">
                            {{ translate('Apply Now') }}
                        </a>
                    </div> -->
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-8">
                    <p>Copyright © Boomerdash - {{date('Y')}}. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="d-xl-none d-lg-none d-block">
    <div class="mobile-navigation-bar">
        <ul>
            <li>
                <a href="#0">
                    <img src="newfas/img/svg/profile.svg" alt="">
                </a>
            </li>
            <li>
                <a href="#0">
                    <img src="newfas/img/svg/money-transfering.svg" alt="">
                </a>
            </li>
            <li>
                <a href="#0">
                    <img src="newfas/img/svg/calculator.svg" alt="">
                </a>
            </li>
            <li>
                <a href="#header">
                    <img src="newfas/img/svg/arrow.svg" alt="">
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="d-xl-block d-lg-block d-none">
    <div class="back-to-top-btn">
        <a href="#">
            <img src="{{ static_asset('newfas/img/svg/arrow.svg') }}" alt="">
        </a>
    </div>
</div>

<!-- jquery -->
<script src="{{ static_asset('newfas/js/jquery.js') }}"></script>
<!-- popper js -->
<script src="{{ static_asset('newfas/js/popper.min.js') }}"></script>
<!-- bootstrap -->
<script src="{{ static_asset('newfas/js/bootstrap.min.js') }}"></script>
<!-- modal video js -->
<script src="{{ static_asset('newfas/js/jquery-modal-video.min.js') }}"></script>
<!-- slick js -->
<script src="{{ static_asset('newfas/js/slick.min.js') }}"></script>
<!-- toastr js -->
<script src="{{ static_asset('newfas/js/toastr.min.js') }}"></script>
<!-- investment profit calculator-->
<script src="{{ static_asset('newfas/js/investment-profit-calculator.js') }}"></script>
<!-- main -->
<script src="{{ static_asset('newfas/js/main.js') }}"></script>

</body>


<!-- Mirrored from iamubaidah.com/html/oitila/live/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 14 Apr 2023 20:02:40 GMT -->

</html>