<section class="bg-dark-footer py-5 text-light-footer footer-widget">
    <div class="container-fluid">
        <div class="row px-2 py-4 px-md-4 py-md-3">
            <div class="col-lg-4 col-md-3 col-12 text-center mr-0">
                <!--<a href="#" class="d-block">-->
                @if(get_setting('footer_logo') != null)
                <img class="lazyload" src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ uploaded_asset(get_setting('footer_logo')) }}" alt="{{ env('APP_NAME') }}" height="auto" width="400">
                @else
                <img class="lazyload" src="{{ static_asset('assets/img/placeholder-rect.jpg') }}" data-src="{{ static_asset('assets/img/logo.png') }}" width="400" alt="{{ env('APP_NAME') }}" height="auto">
                @endif
                <!--</a>-->
            </div>
            <div class="col-lg-3 col-md-2 col-6 mr-0">
                <div class=" text-md-left mt-4">
                    <h4 class="fs-13 text-uppercase fw-600 pb-2 mb-4">
                        {{ translate('ABOUT') }}
                    </h4>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a class=" hov-opacity-100 text-reset" href="{{ url('/about-us') }}">{{ translate('About us') }}</a>
                        </li>
                        <li class="mb-2">
                            <a class=" hov-opacity-100 text-reset" href="{{ url('/contact-us') }}">{{ translate('Contact us') }}</a>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-2 col-6 mr-0">
                <div class=" text-md-left mt-4">
                    <h4 class="fs-13 text-uppercase fw-600  pb-2 mb-4">
                        {{ translate('Information') }}
                    </h4>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a class=" hov-opacity-100 text-reset" href="{{ url('/terms-conditions') }}">
                                {{ translate('Terms of Use') }}
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class=" hov-opacity-100 text-reset" href="{{ url('/privacy-policy') }}">
                                Privacy Policy </a>
                        </li>
                        <li class="mb-2">
                            <a class="hov-opacity-100 text-reset" href="https://proprospecting.org/?page_id=325">
                                Advertise with us
                            </a>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="col-md-2 col-lg-2 col-6">
                <div class=" text-md-left mt-4">
                    <h4 class="fs-13 text-uppercase fw-600  pb-2 mb-4">
                        {{ translate('My Account') }}
                    </h4>
                    <ul class="list-unstyled">
                        @if (Auth::check())
                        <li class="mb-2">
                            <a class=" hov-opacity-100 text-reset" href="{{ route('logout') }}">
                                {{ translate('Logout') }}
                            </a>
                        </li>
                        @else
                        <li class="mb-2">
                            <a class=" hov-opacity-100 text-reset" href="{{ route('user.login') }}">
                                {{ translate('Login') }}
                            </a>
                        </li>
                        @endif
                        <!--<li class="mb-2">-->
                        <!--    <a class=" hov-opacity-100 text-reset" href="{{ route('wishlists.index') }}">-->
                        <!--        {{ translate('My Wishlist') }}-->
                        <!--    </a>-->
                        <!--</li>-->
                        <!-- <li class="mb-2">
                            <a class=" hov-opacity-100 text-reset" href="{{ route('purchase_history.index') }}">
                                {{ translate('Order History') }}
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class=" hov-opacity-100 text-reset" href="{{ route('wishlists.index') }}">
                                {{ translate('My Wishlist') }}
                            </a>
                        </li>
                        <li class="mb-2">
                            <a class=" hov-opacity-100 text-reset" href="{{ route('orders.track') }}">
                                {{ translate('Track Order') }}
                            </a>
                        </li> -->
                        @if (addon_is_activated('affiliate_system'))
                        <!-- <li class="mb-2">
                                <a class=" hov-opacity-100 text-light-footer" href="{{ route('affiliate.apply') }}">{{ translate('Be an affiliate partner')}}</a>
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
</section>

<!-- FOOTER -->
<footer class="pt-3 pb-7 pb-xl-3 bg-black text-light-footer">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-12 justify-content-center">
                <p style="font-size: 14px; color: white; text-align:center;" class="mb-0">© {{date('Y')}}. All Rights Reserved by Boomerdash.</p>
            </div>
            <!-- <div class="col-lg-12 justify-content-center">
                <div class="text-center" current-verison="{{get_setting("current_version")}}">
                    {!! get_setting('frontend_copyright_text',null,App::getLocale()) !!}
                </div>
            </div> -->
            <div class="col-lg-4">
                @if ( get_setting('show_social_links') )
                <ul class="list-inline my-3 my-md-0 social colored text-center">
                    @if ( get_setting('facebook_link') != null )
                    <li class="list-inline-item">
                        <a href="{{ get_setting('facebook_link') }}" target="_blank" class="facebook"><i class="lab la-facebook-f"></i></a>
                    </li>
                    @endif
                    @if ( get_setting('twitter_link') != null )
                    <li class="list-inline-item">
                        <a href="{{ get_setting('twitter_link') }}" target="_blank" class="twitter"><i class="lab la-twitter"></i></a>
                    </li>
                    @endif
                    @if ( get_setting('instagram_link') != null )
                    <li class="list-inline-item">
                        <a href="{{ get_setting('instagram_link') }}" target="_blank" class="instagram"><i class="lab la-instagram"></i></a>
                    </li>
                    @endif
                    @if ( get_setting('youtube_link') != null )
                    <li class="list-inline-item">
                        <a href="{{ get_setting('youtube_link') }}" target="_blank" class="youtube"><i class="lab la-youtube"></i></a>
                    </li>
                    @endif
                    @if ( get_setting('linkedin_link') != null )
                    <li class="list-inline-item">
                        <a href="{{ get_setting('linkedin_link') }}" target="_blank" class="linkedin"><i class="lab la-linkedin-in"></i></a>
                    </li>
                    @endif
                </ul>
                @endif
            </div>
            <div class="col-lg-4">
                <div class="text-center text-md-right">
                    <ul class="list-inline mb-0">
                        @if ( get_setting('payment_method_images') != null )
                        @foreach (explode(',', get_setting('payment_method_images')) as $key => $value)
                        <li class="list-inline-item">
                            <img src="{{ uploaded_asset($value) }}" height="30" class="mw-100 h-auto" style="max-height: 30px">
                        </li>
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>


<div class="aiz-mobile-bottom-nav d-xl-none fixed-bottom bg-white shadow-lg border-top rounded-top" style="display:none; box-shadow: 0px -1px 10px rgb(0 0 0 / 15%)!important; ">
    <div class="row align-items-center gutters-5">
        <div class="col">
            <a href="{{ route('dashboard') }}" class="text-reset d-block text-center pb-2 pt-3">
                <i class="las la-home fs-20 opacity-60 {{ areActiveRoutes(['home'],'opacity-100 text-primary')}}"></i>
                <span class="d-block fs-10 fw-600 opacity-60 {{ areActiveRoutes(['home'],'opacity-100 fw-600')}}">{{ translate('Home') }}</span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('search') }}" class="text-reset d-block text-center pb-2 pt-3">
                <i class="las la-list-ul fs-20 opacity-60 {{ areActiveRoutes(['categories.all'],'opacity-100 text-primary')}}"></i>
                <span class="d-block fs-10 fw-600 opacity-60 {{ areActiveRoutes(['categories.all'],'opacity-100 fw-600')}}">{{ translate('Shop') }}</span>
            </a>
        </div>
        @php
        if(auth()->user() != null) {
        $user_id = Auth::user()->id;
        $cart = \App\Models\Cart::where('user_id', $user_id)->get();
        } else {
        $temp_user_id = Session()->get('temp_user_id');
        if($temp_user_id) {
        $cart = \App\Models\Cart::where('temp_user_id', $temp_user_id)->get();
        }
        }
        @endphp
        <div class="col-auto">
            <a href="{{ route('cart') }}" class="text-reset d-block text-center pb-2 pt-3">
                <span class="align-items-center bg-primary border border-white border-width-4 d-flex justify-content-center position-relative rounded-circle size-50px" style="margin-top: -33px;box-shadow: 0px -5px 10px rgb(0 0 0 / 15%);border-color: #fff !important;">
                    <i class="lab la-gratipay la-2x text-white"></i>
                </span>
                <span class="d-block mt-1 fs-10 fw-600 opacity-60 {{ areActiveRoutes(['cart'],'opacity-100 fw-600')}}">
                    {{ translate('List') }}
                    @php
                    $count = (isset($cart) && count($cart)) ? count($cart) : 0;
                    @endphp
                    (<span class="cart-count">{{$count}}</span>)
                </span>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('videos') }}" class="text-reset d-block text-center pb-2 pt-3">
                <i class="las la-list-ul fs-20 opacity-60 {{ areActiveRoutes(['categories.all'],'opacity-100 text-primary')}}"></i>
                <span class="d-block fs-10 fw-600 opacity-60 {{ areActiveRoutes(['categories.all'],'opacity-100 fw-600')}}">{{ translate('Watch') }}</span>
            </a>
        </div>
        <!--<div class="col">-->
        <!--    <a href="{{ route('all-notifications') }}" class="text-reset d-block text-center pb-2 pt-3">-->
        <!--        <span class="d-inline-block position-relative px-2">-->
        <!--            <i class="las la-bell fs-20 opacity-60 {{ areActiveRoutes(['all-notifications'],'opacity-100 text-primary')}}"></i>-->
        <!--            @if(Auth::check() && count(Auth::user()->unreadNotifications) > 0)-->
        <!--                <span class="badge badge-sm badge-dot badge-circle badge-primary position-absolute absolute-top-right" style="right: 7px;top: -2px;"></span>-->
        <!--            @endif-->
        <!--        </span>-->
        <!--        <span class="d-block fs-10 fw-600 opacity-60 {{ areActiveRoutes(['all-notifications'],'opacity-100 fw-600')}}">{{ translate('Notifications') }}</span>-->
        <!--    </a>-->
        <!--</div>-->
        <div class="col">
            @if (Auth::check())
            @if(isAdmin())
            <a href="{{ route('admin.dashboard') }}" class="text-reset d-block text-center pb-2 pt-3">
                <span class="d-block mx-auto">
                    @if(Auth::user()->photo != null)
                    <img src="{{ custom_asset(Auth::user()->avatar_original)}}" class="rounded-circle size-20px">
                    @else
                    <img src="{{ static_asset('assets/img/avatar-place.png') }}" class="rounded-circle size-20px">
                    @endif
                </span>
                <span class="d-block fs-10 fw-600 opacity-60">{{ translate('Account') }}</span>
            </a>
            @else
            <a href="javascript:void(0)" class="text-reset d-block text-center pb-2 pt-3 mobile-side-nav-thumb" data-toggle="class-toggle" data-backdrop="static" data-target=".aiz-mobile-side-nav">
                <span class="d-block mx-auto">
                    @if(Auth::user()->photo != null)
                    <img src="{{ custom_asset(Auth::user()->avatar_original)}}" class="rounded-circle size-20px">
                    @else
                    <img src="{{ static_asset('assets/img/avatar-place.png') }}" class="rounded-circle size-20px">
                    @endif
                </span>
                <span class="d-block fs-10 fw-600 opacity-60">{{ translate('Account') }}</span>
            </a>
            @endif
            @else
            <a href="{{ route('user.login') }}" class="text-reset d-block text-center pb-2 pt-3">
                <span class="d-block mx-auto">
                    <img src="{{ static_asset('assets/img/avatar-place.png') }}" class="rounded-circle size-20px">
                </span>
                <span class="d-block fs-10 fw-600 opacity-60">{{ translate('Account') }}</span>
            </a>
            @endif
        </div>
    </div>
</div>
@if (Auth::check() && !isAdmin())
<div class="aiz-mobile-side-nav collapse-sidebar-wrap sidebar-xl d-xl-none z-1035">
    <div class="overlay dark c-pointer overlay-fixed" data-toggle="class-toggle" data-backdrop="static" data-target=".aiz-mobile-side-nav" data-same=".mobile-side-nav-thumb"></div>
    <div class="collapse-sidebar bg-white">
        @include('frontend.inc.user_side_nav')
    </div>
</div>
@endif