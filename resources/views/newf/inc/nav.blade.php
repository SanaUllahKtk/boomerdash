 <!-- header begin -->
 <div class="header" id="header">
                <div class="bottom">
                    <div class="container-fluid px-4">
                        <div class="row justify-content-between">
                            <div class="col-xl-3 col-lg-2 d-xl-flex d-lg-flex d-block align-items-center"> 
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-6 d-xl-block d-lg-block d-flex align-items-center">
                                    @php
                                        $header_logo = get_setting('header_logo');
                                    @endphp
                                   
                                        <div class="logo">
                                            <a href="{{ route('home') }}">
                                            @if($header_logo != null)
                                                <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}" class="mw-100 " height="auto" width="200" style="height:auto">
                                                @else
                                                <img src="{{ static_asset('assets/img/logo.png') }}" alt="{{ env('APP_NAME') }}" class="mw-100 " height="auto" width="200">
                                            @endif
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-6 d-xl-none d-lg-none d-block">
                                        <button class="navbar-toggler koivname" type="button" style="float: right; ">
                                            <span class="dag"></span>
                                            <span class="dag2"></span>
                                            <span class="dag3"></span>
                                        </button>    
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-9 col-lg-10">
                                <div class="mainmenu">
                                    <div class="d-xl-none d-lg-none d-block" style="background-color: aliceblue; padding: 5%;">
                                       <ul>
                        <!--@auth-->
                        <!--<li class="mb-2">-->
                        <!--    <a style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); border:none;margin:20px auto; font-weight:bold" href="{{ route('logout') }}" class="btn-hyipox-2">{{ translate('Logout')}}</a>-->
                        <!--</li>-->
                        <!--@else-->
                        <!--<li class="mb-2">-->
                        <!--     <a style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); border:none;margin:20px auto; font-weight:bold" class="btn-hyipox-2" href="{{route('login')}}">sign in</a>-->
                        <!--</li>-->
                        <!--@endauth -->
                                           
                                
                                              <li>
                                        <button class="navbar-toggler close-btn" type="button" style="float: unset; background-color: darkgray;">
                                            <span class="dag"></span>
                                            <span class="dag2"></span>
                                            <span class="dag3"></span>
                                        </button>
                                        </li>
                                       </ul>
                                       
                                    </div>
                                    <nav class="navbar navbar-expand-lg">   
                                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                            <!--<ul class="navbar-nav ml-auto">            -->
                    <!--@auth-->
                  
                    <!--    <li class="list-inline-item" style="padding-top: 20px;">-->
                    <!--        <a href="{{ route('logout') }}" class="text-reset d-inline-block opacity-60 py-2">{{ translate('Logout')}}</a>-->
                    <!--    </li>-->
                    <!--@else     -->
                    <!-- <ul>-->
                    <!--                        @auth-->
                    <!--                        <li class="list-inline-item">-->
                    <!--                        <a class="opacity-50 hov-opacity-100 text-reset"  href="{{ route('dashboard') }}">{{ translate('Dashboard') }}</a>-->
                    <!--                        </li>-->
                    <!--                        @else-->
                    <!--                        <li class="list-inline-item">-->
                    <!--                        <a class="opacity-50 hov-opacity-100 text-reset" href="https://boomerdash.com/">{{ translate('Home') }}</a>-->
                    <!--                        </li>-->
                    <!--                        @endauth-->
                                           
                                       
                    <!--<li class="list-inline-item" style="padding-top: 20px;">-->
                    <!--        <a href="{{ url('/about-us') }}" class="text-reset d-inline-block opacity-60 py-2">{{ translate('About us') }}</a>-->
                    <!--    </li> -->
                    <!--    <li class="list-inline-item" style="padding-top: 20px;">-->
                    <!--        <a href="{{ url('/contact-us') }}" class="text-reset d-inline-block opacity-60 py-2">{{ translate('Contact us') }}</a>-->
                    <!--    </li> -->
                    <!--    <li class="nav-item join-now-btn">-->
                    <!--         <a class="nav-link" style="font-weight:bold" href="{{route('login')}}">sign in</a>-->
                    <!--    </li>-->
                    <!--     </ul>-->
                    <!--                            @endauth-->
                                            <!--</ul>-->
                                            
                                            
                                            
                                            
                                            <ul class="navbar-nav ml-auto" style="margin: auto;">
                                @auth
                                 <li class="list-inline-item mr-0">
                                    <a href="{{ route('dashboard') }}" style="color: #3d5169;" class="dul opacity-60 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">{{ translate('Dashboard') }}</a>
                                </li>
                                <li class="list-inline-item mr-0">
                                    <a href="https://boomerdash.com/search" class="dul opacity-60 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">Shop</a>
                                </li>
                                <li class="list-inline-item mr-0">
                                    <a href="https://boomerdash.com/videos" class="dul opacity-60 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">Watch</a>
                                </li>
                                @else
                                 <li class="list-inline-item mr-0">
                                    <a href="https://boomerdash.com/" class="dul opacity-60 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">Home</a>
                                </li>
                                 @endauth
                                 <li class="list-inline-item mr-0">
                                    <a href="{{ url('/about-us') }}" class="dul opacity-60 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">About us</a>
                                </li>
                               
                                <li class="list-inline-item mr-0">
                                    <a href="{{ url('/contact-us') }}"  class="dul opacity-60 fs-14 px-3 py-2 d-inline-block fw-600 hov-opacity-100 text-reset">Contact Us</a>
                                </li>
                                
                                
                                 

                    <!--             @auth-->
                  
                    <!--    <li class="list-inline-item" style="padding-top: 20px;">-->
                    <!--        <a href="{{ route('logout') }}" class="text-reset d-inline-block opacity-60 py-2">{{ translate('Logout')}}</a>-->
                    <!--    </li>-->
                    <!--    @else-->
                    <!--                                     <li class="nav-item join-now-btn">-->
                    <!--         <a class="nav-link" style="font-weight:bold" href="{{route('login')}}">sign in</a>-->
                    <!--    </li>-->
                    <!--@endauth -->
                            </ul>
                            <ul class="navbar-nav">
                                 @auth
                        <li class="list-inline-item">
                            <a style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); font-weight:bold" href="{{ route('logout') }}" class="btn-hyipox-2">{{ translate('Logout')}}</a>
                        </li>
                        @else
                        <li class="list-inline-item">
                             <a style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); font-weight:bold" class="btn-hyipox-2" href="{{route('login')}}">sign in</a>
                        </li>
                        @endauth 
                            </ul>
                            
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header end -->
            <script>
            </script>