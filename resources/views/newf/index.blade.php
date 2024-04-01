@extends('newf.layouts.app')

@section('content')
    <!-- banner begin -->
    <div class="banner">
                <div class="container">
                    <div class="row justify-content-xl-between justify-content-lg-between justify-content-md-center justify-content-sm-center">
                        <div class="col-xl-7 col-lg-7 col-sm-10 col-md-9 d-xl-flex d-lg-flex d-block align-items-center d-banner-tamim">
                            <div class="banner-content">
                                <h1>A real Way to Earn Money Online</h1>
                                <p>Convert points to cash instantly by requesting a payout to your Boomerdash loyalty rewards visa card</p>
                                <a href="{{ route('user.registration') }}" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); border:none; font-weight:bold" class="btn-hyipox-2">Start Earning Now</a>
                            </div>
                            
                        </div>
                        <div class="col-xl-4 col-lg-5 col-sm-10 col-md-8 monitor-for-480">
                            <div class="profit-calculator">
                                <div class="calc-header">
                                    <h3 class="title" style="font-style:normal; font-weight:bold">Earn Cash and Rewards </h3>
                                </div>
                                <style>
                                    .form_inp{
                                        width: 100%;
                                        height: 40px;
                                        padding: 0 30px;
                                        background: transparent;
                                        color: gray;
                                        border: 1px solid gray;
                                        border-radius: 5px;
                                        margin-bottom: 20px;
                                        display: block;
                                    }
                                    .slider_tabs{
                                        display: flex;
                                        justify-content: center;
                                        align-items: center;
                                    }
                                    .single-feature{
                                        display: flex;
                                        align-items: center;
                                        padding-bottom: 20px;
                                    }
                                    button, a{
                                        cursor: pointer;
                                    }
                                    @media(max-width:768px){
                                        .slider_tabs{
                                            justify-content: flex-start !important;
                                        }
                                    }
                                </style>
                                <div class="calc-body">
                                <form id="reg-form" class="form-default" role="form" action="{{ route('register') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" placeholder="{{  translate('Full Name') }}" name="name" required>
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        @if (addon_is_activated('otp_system'))
                                            <div class="form-group phone-form-group mb-1">
                                                <input type="tel"  required id="phone-code" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" placeholder="" name="phone" autocomplete="off">
                                            </div>

                                            <input type="hidden" name="country_code" value="">

                                            <div class="form-group email-form-group mb-1 d-none">
                                                <input type="email" required class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email"  autocomplete="off">
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group text-right">
                                                <button class="btn btn-link p-0 opacity-50 text-reset" type="button" onclick="toggleEmailPhone(this)">{{ translate('Use Email Instead') }}</button>
                                            </div>
                                        @else
                                            <div class="form-group">
                                                <input type="email" required class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{  translate('Password') }}" name="password" required>
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input type="password" required class="form-control" placeholder="{{  translate('Confirm Password') }}" name="password_confirmation">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                               <input type="text" required class="form-control" placeholder="{{  translate('Phone') }}" name="phone">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                Date of Birth
                                               <input type="date" required class="form-control" placeholder="{{  translate('Date of Birth') }}" id="dob" name="dob">
                                            </div>
                                        </div>
                                        
                                        
                                                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <select class="form-control aiz-selectpicker" data-live-search="true" data-placeholder="{{ translate('Select your country') }}" name="country" required>
                                                        <option value="">{{ translate('Select your country') }}</option>
                                                        @foreach (\App\Models\Country::where('status', 1)->get() as $key => $country)
                                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                       
                                        <div class="row">
                                            <div class="col-md-12">
                                                <select class="form-control mb-3 aiz-selectpicker" data-placeholder="{{ translate('Select your State') }}" data-live-search="true" name="state" required>
                                                </select> 
                                            </div>
                                        </div>
                
                                        <div class="row">
                                            <div class="col-md-12">
                                                <select class="form-control mb-3 aiz-selectpicker"  data-placeholder="{{ translate('Select your City') }}" data-live-search="true" name="city" required>
                
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="{{  translate('postal_code') }}" name="postal_code" required>
                                        </div>
                                         <div class="row">
                                            <div class="col-md-12 mb-3">
                                               <input type="text" class="form-control" required placeholder="{{  translate('Street Address') }}" name="st_address">
                                            </div>
                                        </div>

                                        @if(get_setting('google_recaptcha') == 1)
                                            <div class="form-group">
                                                <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>
                                            </div>
                                        @endif

                                        <div class="mb-3">
                                            <label class="aiz-checkbox">
                                                <input type="checkbox" name="checkbox_example_1" required>
                                                <a style="color: black;" href="https://www.boomerdash.com/privacy-policy">
                                                    <span class=opacity-60>{{ translate('By signing up, I  agree to the Terms of Use and to receive marketing emails from Boomerdash and I accept the Privacy Policy.')}}</span>
                                                </a>
                                                <span class="aiz-square-check"></span>
                                            </label>
                                        </div>

                                        <div class="mb-5">
                                        <button type="submit" id="createBtn" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); border:none; display:block; margin:0 auto" class="btn-hyipox-2">Signup</button>
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- banner end -->
 
            <!-- about begin -->
            <div class="about">
                <!--<div class="container">-->
                <!--    <div class="how-to-works">-->
                <!--        <div class="row justify-content-center justify-content-sm-center justify-content-md-start">-->
                <!--            <div class="col-xl-4 col-lg-4 col-sm-10 col-md-6">-->
                <!--                <div class="single-system slider_tabs">-->
                <!--                    <div class="part-icon">-->
                <!--                        <img width="50" src="{{ static_asset('newfas/img/svg/multimedia.png') }}" alt="">-->
                <!--                    </div>-->
                <!--                    <div class="part-text">-->
                <!--                        <h4 class="title">Watching Videos</h4>-->
                <!--                         <p>Register for an account. It's totally easy and free</p> -->
                <!--                    </div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--            <div class="col-xl-4 col-lg-4 col-sm-10 col-md-6">-->
                <!--                <div class="single-system slider_tabs">-->
                <!--                    <div class="part-icon">-->
                <!--                        <img width="50" src="{{ static_asset('newfas/img/svg/add-to-cart.png') }}" alt="">-->
                <!--                    </div>-->
                <!--                    <div class="part-text">-->
                <!--                        <h4 class="title">Redeem your Bills</h4>-->
                <!--                         <p>Choose your investment plan and make first deposit</p> -->
                <!--                    </div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--            <div class="col-xl-4 col-lg-4 col-sm-10 col-md-6">-->
                <!--                <div class="single-system slider_tabs">-->
                <!--                    <div class="part-icon">-->
                <!--                        <img width="50" src="{{ static_asset('newfas/img/svg/laptop.png') }}" alt="">-->
                <!--                    </div>-->
                <!--                    <div class="part-text">-->
                <!--                        <h4 class="title">Article Reading</h4>-->
                <!--                         <p>Request for the withdrawal and receive a payment</p> -->
                <!--                    </div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <div class="container" style="margin-top:5%;">
                    <div class="row justify-content-xl-between justify-content-lg-between justify-content-md-between justify-content-sm-center">
                        <div class="col-xl-6 col-lg-6 col-sm-10">
                            <div class="part-text">
                                <h2>How it <span class="special">Works</span></h2>
                                <h4>
                                    Earn Points
                                </h4>
                                <p>Shop online and in stores to earn cash back on everyday purchases, 
read articles, watch videos, complete challenges and find great deals 
to earn points.</p>
                                <h4>
                                    Redeem Points
                                </h4>
                                <p>Redeem your points for cash via Boomerdash loyalty rewards visa card</p>
                                <a href="{{ route('user.registration') }}" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); border:none; font-weight:bold" class="btn-hyipox-2">Earn Now</a>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-6 col-sm-10 col-md-12">
                            <div class="part-feature">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-sm-12 col-md-6">
                                        <div class="single-feature">
                                            <div class="feature-icon">
                                                <img src="{{ static_asset('newfas/img/svg/solar-energy.svg') }}" alt="">
                                            </div>
                                            <div class="feature-text ico_text">
                                                <p>Brands pay us advertising dollars</p>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-sm-12 col-md-6">
                                        <div class="single-feature">
                                            <div class="feature-icon">
                                                <img src="{{ static_asset('newfas/img/svg/diploma.svg') }}" alt="">
                                            </div>
                                            <div class="feature-text ico_text">
                                                <p>We recruit members like you  </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-sm-12 col-md-6">
                                        <div class="single-feature">
                                            <div class="feature-icon">
                                                <img src="{{ static_asset('newfas/img/svg/blockchain.svg') }}" alt="">
                                            </div>
                                            <div class="feature-text ico_text">
                                                <p>You interact with our partner brands to earn points and cash back</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-sm-12 col-md-6">
                                        <div class="single-feature">
                                            <div class="feature-icon">
                                                <img src="{{ static_asset('newfas/img/svg/worldwide.svg') }}" alt="">
                                            </div>
                                            <div class="feature-text ico_text">
                                                <p>We pay you in cash when you redeem your points </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- about end -->

            <!-- testimonial end -->

            <!-- payment gateway begin -->
            <!--<div class="payment-gateway">-->
            <!--    <div class="container">-->
            <!--        <div class="row justify-content-xl-between justify-content-lg-between justify-content-md-between justify-content-sm-center">-->
            <!--            <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12 d-xl-flex d-lg-flex d-block align-items-center">-->
            <!--                <div class="part-text">-->
            <!--                    <h2 style="text-align:center">Our Partners</h2>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--        <div class="row justify-content-center">-->
            <!--            <div class="col-xl-12 col-lg-12 col-sm-10 col-md-12">-->
            <!--                <div class="all-payment">-->
                            <!-- <h3 class="title">local payment gateway :</h3> -->
            <!--                    <div class="gateway-slider">-->
            <!--                        <div class="single-payment-way">-->
            <!--                            <img src="{{ static_asset('newfas/img/svg/buzz.svg') }}" alt="">-->
            <!--                        </div>-->
            <!--                        <div class="single-payment-way">-->
            <!--                            <img src="{{ static_asset('newfas/img/svg/save.svg') }}" alt="">-->
            <!--                        </div>-->
            <!--                        <div class="single-payment-way">-->
            <!--                            <img src="{{ static_asset('newfas/img/svg/peny.svg') }}" alt="">-->
            <!--                        </div>-->
            <!--                        <div class="single-payment-way">-->
            <!--                            <img src="{{ static_asset('newfas/img/svg/abc.svg') }}" alt="">-->
            <!--                        </div>-->
            <!--                        <div class="single-payment-way">-->
            <!--                            <img src="{{ static_asset('newfas/img/svg/huffing.svg') }}" alt="">-->
            <!--                        </div>-->
                                   
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
@endsection

@section('script')
    @if(get_setting('google_recaptcha') == 1)
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif

  <script type="text/javascript">
                    
        $(document).on('change', '[name=country]', function() {
          
            var country_id = $(this).val();
            get_states(country_id);
        });

        $(document).on('change', '[name=state]', function() {
            var state_id = $(this).val();
            get_city(state_id);
        });
        
        @if(get_setting('google_recaptcha') == 1)
        // making the CAPTCHA  a required field for form submission
        $(document).ready(function(){
            // alert('helloman');
            $("#reg-form").on("submit", function(evt)
            {
                var response = grecaptcha.getResponse();
                if(response.length == 0)
                {
                //reCaptcha not verified
                    alert("please verify you are humann!");
                    evt.preventDefault();
                    return false;
                }
                //captcha verified
                //do the rest of your validations here
                $("#reg-form").submit();
            });
            
        });
        @endif

    
        

        function get_states(country_id) {
            $('[name="state"]').html("");
            $.ajax({
                headers: { 
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('get-state')}}",
                type: 'POST',
                data: {
                    country_id  : country_id
                },
                success: function (response) {
                    var obj = JSON.parse(response);
                    if(obj != '') {
                        $('[name="state"]').html(obj);
                        AIZ.plugins.bootstrapSelect('refresh');
                    }
                }
            });
        }

        function get_city(state_id) {
            $('[name="city"]').html("");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('get-city')}}",
                type: 'POST',
                data: {
                    state_id: state_id
                },
                success: function (response) {
                    var obj = JSON.parse(response);
                    if(obj != '') {
                        $('[name="city"]').html(obj);
                        AIZ.plugins.bootstrapSelect('refresh');
                    }
                }
            });
        }

        $("#dob").on('change', function() {
            var dob = new Date($(this).val());
            var today = new Date();
            var age = today.getFullYear() - dob.getFullYear();
            var m = today.getMonth() - dob.getMonth();

            if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
                age--;
            }

            if (age < 50) {
                toastr.error('Sorry, you cannot sign up at this time. You must be at least 50 years old to register.');
                $("#createBtn").prop('disabled', true);
            } else {
                $("#createBtn").prop('disabled', false);
            }
        });
    </script>
@endsection


