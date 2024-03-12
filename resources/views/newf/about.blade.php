
@extends('newf.layouts.app')


@section('content')

<div class="about about-inner">
                <div class="container">
                    <div class="how-to-works">
                        <div class="row justify-content-center justify-content-sm-center justify-content-md-start">
                            <div class="col-xl-4 col-lg-4 col-sm-10 col-md-6">
                                <div class="single-system">
                                    <div class="part-icon">
                                        <img src="{{ static_asset('newfas/img/svg/add-user.svg') }}" alt="">
                                    </div>
                                    <div class="part-text">
                                        <h4 class="title">Register Account</h4>
                                        <p>Register for an account. It's totally easy and free</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-sm-10 col-md-6">
                                <div class="single-system">
                                    <div class="part-icon">
                                        <img src="{{ static_asset('newfas/img/svg/coin.svg') }}" alt="">
                                    </div>
                                    <div class="part-text">
                                        <h4 class="title">Earn Money</h4>
                                        <p>Choose your investment plan and make first deposit</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-sm-10 col-md-6">
                                <div class="single-system">
                                    <div class="part-icon">
                                        <img src="{{ static_asset('newfas/img/svg/money-bag.svg') }}" alt="">
                                    </div>
                                    <div class="part-text">
                                        <h4 class="title">Get Withdraw</h4>
                                        <p>Request for the withdrawal and receive a payment</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row justify-content-xl-between justify-content-lg-between justify-content-md-between justify-content-sm-center">
                        <div class="col-xl-6 col-lg-6 col-sm-10">
                            <div class="part-text">
                                <h2>A <span class="special"> real way </span> to earn money online</h2>
                                <p>No gimmicks. Earn money with participation by watching videos, 
redeeming offers, reading articles, participating in healthy 
challenges, shop and earn cashback and much more!
</p>
                                <ul>
                                    <li><i class="fas fa-check"></i> No gimmicks </li>
                                    <li><i class="fas fa-check"></i> Earn money with participation </li>
                                    <li><i class="fas fa-check"></i> Withdraw money to your Boomerdash loyalty rewards visa card </li>
                                    <li><i class="fas fa-check"></i> Tell your family and friends</li>
                                </ul>
                                <a href="{{ route('user.registration') }}" class="btn-hyipox-2">Earn now</a>
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
                                            <div class="feature-text">
                                                <h3>We Innovate</h3>
                                                <p>We are bringing people and brands together </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-sm-12 col-md-6">
                                        <div class="single-feature">
                                            <div class="feature-icon">
                                                <img src="{{ static_asset('newfas/img/svg/diploma.svg') }}" alt="">
                                            </div>
                                            <div class="feature-text">
                                                <h3>We Grow</h3>
                                                <p>There is much more to come in the future as we create partnerships that will make a difference </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-sm-12 col-md-6">
                                        <div class="single-feature">
                                            <div class="feature-icon">
                                                <img src="{{ static_asset('newfas/img/svg/blockchain.svg') }}" alt="">
                                            </div>
                                            <div class="feature-text">
                                                <h3>We Provide Support</h3>
                                                <p>We provide support to our members inside the dashboard. We are equipped and eager to assist you</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-sm-12 col-md-6">
                                        <div class="single-feature">
                                            <div class="feature-icon">
                                                <img src="{{ static_asset('newfas/img/svg/worldwide.svg') }}" alt="">
                                            </div>
                                            <div class="feature-text">
                                                <h3>We're Excited</h3>
                                                <p>Boomerdash believes in education and fun. We are excited to bring the two worlds together through partnerships with our members and our brands</p>
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

            <!-- statics begin -->
            <!--<div class="statics">-->
            <!--    <div class="container">-->
            <!--        <div class="all-statics">-->
                        <!--<div class="row no-gutters justify-content-center">-->
                        <!--    <div class="col-xl-4 col-lg-3 col-sm-10 col-md-4">-->
                        <!--        <div class="single-statics">-->
                        <!--            <div class="part-img">-->
                        <!--                <img src="{{ static_asset('newfas/img/svg/investor.svg') }}" alt="investor">-->
                        <!--            </div>-->
                        <!--            <div class="part-text">-->
                        <!--                <span class="counter">565+</span>-->
                        <!--                <span class="title">total investor</span>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <div class="col-xl-4 col-lg-3 col-sm-10 col-md-4">-->
                        <!--        <div class="single-statics">-->
                        <!--            <div class="part-img">-->
                        <!--                <img src="{{ static_asset('newfas/img/svg/withdraw.svg') }}" alt="investor">-->
                        <!--            </div>-->
                        <!--            <div class="part-text">-->
                        <!--                <span class="counter">255+</span>-->
                        <!--                <span class="title">total withdraw</span>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <div class="col-xl-4 col-lg-3 col-sm-10 col-md-4">-->
                        <!--        <div class="single-statics">-->
                        <!--            <div class="part-img">-->
                        <!--                <img src="{{ static_asset('newfas/img/svg/money-transfering.svg') }}" alt="investor">-->
                        <!--            </div>-->
                        <!--            <div class="part-text">-->
                        <!--                <span class="counter">265+</span>-->
                        <!--                <span class="title">total transaction</span>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <!-- statics end -->

            <!-- team inner begin -->
            <!--<div class="team-inner">-->
            <!--    <div class="container">-->
            <!--        <div class="row justify-content-center">-->
            <!--            <div class="col-xl-8 col-lg-8">-->
            <!--                <div class="section-title">-->
            <!--                    <span class="sub-title">-->
            <!--                        Uppermost Investments-->
            <!--                    </span>-->
            <!--                    <h2>-->
            <!--                        Meet with our<span class="special">  Top Investors</span>-->
            <!--                    </h2>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--        <div class="row">-->
            <!--            <div class="col-xl-3 col-lg-3 col-sm-6">-->
            <!--                <div class="single-box">-->
            <!--                    <div class="part-img">-->
            <!--                        <img src="{{ static_asset('newfas/img/member-1.jpg') }}" alt="image">-->
            <!--                    </div>-->
            <!--                    <div class="part-txt">-->
            <!--                        <h3>Charles Bukowski</h3>-->
            <!--                        <p>founder</p>-->
            <!--                        <div class="social">-->
            <!--                            <a href="#"><i class="fab fa-facebook-f"></i></a>-->
            <!--                            <a href="#"><i class="fab fa-twitter"></i></a>-->
            <!--                            <a href="#"><i class="fab fa-instagram"></i></a>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="col-xl-3 col-lg-3 col-sm-6">-->
            <!--                <div class="single-box">-->
            <!--                    <div class="part-img">-->
            <!--                        <img src="{{ static_asset('newfas/img/member-2.jpg') }}" alt="image">-->
            <!--                    </div>-->
            <!--                    <div class="part-txt">-->
            <!--                        <h3>John Doe Jr</h3>-->
            <!--                        <p>manager</p>-->
            <!--                        <div class="social">-->
            <!--                            <a href="#"><i class="fab fa-facebook-f"></i></a>-->
            <!--                            <a href="#"><i class="fab fa-twitter"></i></a>-->
            <!--                            <a href="#"><i class="fab fa-instagram"></i></a>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="col-xl-3 col-lg-3 col-sm-6">-->
            <!--                <div class="single-box">-->
            <!--                    <div class="part-img">-->
            <!--                        <img src="{{ static_asset('newfas/img/member-3.jpg') }}" alt="image">-->
            <!--                    </div>-->
            <!--                    <div class="part-txt">-->
            <!--                        <h3>Bukowski Charles</h3>-->
            <!--                        <p>cheaf assistant</p>-->
            <!--                        <div class="social">-->
            <!--                            <a href="#"><i class="fab fa-facebook-f"></i></a>-->
            <!--                            <a href="#"><i class="fab fa-twitter"></i></a>-->
            <!--                            <a href="#"><i class="fab fa-instagram"></i></a>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--            <div class="col-xl-3 col-lg-3 col-sm-6">-->
            <!--                <div class="single-box">-->
            <!--                    <div class="part-img">-->
            <!--                        <img src="{{ static_asset('newfas/img/member-1.jpg') }}" alt="image">-->
            <!--                    </div>-->
            <!--                    <div class="part-txt">-->
            <!--                        <h3>Charles Bukowski</h3>-->
            <!--                        <p>founder</p>-->
            <!--                        <div class="social">-->
            <!--                            <a href="#"><i class="fab fa-facebook-f"></i></a>-->
            <!--                            <a href="#"><i class="fab fa-twitter"></i></a>-->
            <!--                            <a href="#"><i class="fab fa-instagram"></i></a>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <!-- team inner end -->

            <!-- call to action begin -->
            <div class="cta">
                <div class="container">
                    <div class="cta-bg">
                        <div class="row justify-content-xl-between justify-content-lg-between justify-content-md-between justify-content-sm-center">
                            <div class="col-xl-7 col-lg-7 col-md-12 col-sm-10 d-xl-flex d-lg-flex d-block align-items-center">
                                <div class="cta-text">
                                    <h2>We're Always Thinking Something Different</h2>
                                    <p>We can promise that we will always put innovation at the forefront of our work. We are building and growing everyday with each of our members in mind. We aim to make our offers resonate with a wide audience. And our ultimate promise is to always aim to be different</p>
                                    
                                    <a href="{{ route('user.registration') }}" class="btn-hyipox-medium cta-btn">Start Earning</a>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 d-xl-flex d-lg-flex justify-content-end d-block align-items-center">
                                <div class="part-video">
                                    <img src="{{ static_asset('newfas/img/video.jpg') }}" alt="">
                                    <button data-video-id="L61p2uyiMSo" class="play-video js-video-button"><i class="fas fa-play"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- call to action end -->

            <!-- choosing reson begin -->
            <div class="choosing-reason">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-8 col-lg-8">
                            <div class="section-title">
                                <span class="sub-title">
                                    Tell your family and friends
                                </span>
                                <h2>
                                    Why Boomerdash Is <span class="special"> The Best</span>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-4 col-lg-5 col-sm-10 col-md-12">
                            <div class="part-left">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-4">
                                        <div class="single-reason">
                                            <div class="icon-box">
                                                <div class="part-icon">
                                                    <img src="{{ static_asset('newfas/img/svg/withdraw.svg') }}" alt="">
                                                </div>
                                            </div>
                                            <div class="part-text">
                                                <h3 class="title">Get Instant Withdrawals</h3>
                                                <p>Get your payment instantly 
through requesting it! We don't 
take percentage </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-4">
                                        <div class="single-reason">
                                            <div class="icon-box">
                                                <div class="part-icon">
                                                    <img src="{{ static_asset('newfas/img/svg/referral.svg') }}" alt="">
                                                </div>
                                            </div>
                                            <div class="part-text">
                                                <h3 class="title">Unlimited Referral Bonus</h3>
                                                <p>Earn cash redeemable points 
when you refer your family and 
friends. Just share your 
personalized referral link</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-4">
                                        <div class="single-reason">
                                            <div class="icon-box">
                                                <div class="part-icon">
                                                    <img src="{{ static_asset('newfas/img/svg/affiliate-marketing.svg') }}" alt="">
                                                </div>
                                            </div>
                                            <div class="part-text">
                                                <h3 class="title">Your Wish List</h3>
                                                <p>Get the people in your life 
involved! Create a wish list and 
share with your family and friends</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-2 d-xl-flex d-lg-none d-block align-items-end">
                            <div class="part-img" style="height: -webkit-fill-available;">
                                <!--<div class="shadow-shape"></div>-->
                                <img src="{{ static_asset('newfas/img/choosing-reason1.png') }}" style="width: 100% !important;height:100% !important; max-width: 100% !important; left: 80% !important; alt="">
                            </div>
                        </div>
                       
                        <div class="col-xl-4 col-lg-5 col-sm-10 col-md-12">
                            <div class="part-right">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-4">
                                        <div class="single-reason">
                                            <div class="icon-box">
                                                <div class="part-icon">
                                                    <img src="{{ static_asset('newfas/img/svg/bird.svg') }}" alt="">
                                                </div>
                                            </div>
                                            <div class="part-text">
                                                <h3 class="title"> Earn Points For Doing 
Everyday Things</h3>
                                                <p>These are everyday things you 
do! With Boomerdash you can 
earn cash redeemable points 
while doing them</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-4">
                                        <div class="single-reason">
                                            <div class="icon-box">
                                                <div class="part-icon">
                                                    <img src="{{ static_asset('newfas/img/svg/shield.svg') }}" alt="">
                                                </div>
                                            </div>
                                            <div class="part-text">
                                                <h3 class="title">SSL Security</h3>
                                                <p>Our system is secured and protected using DDos protection and SSL. </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-4">
                                        <div class="single-reason">
                                            <div class="icon-box">
                                                <div class="part-icon">
                                                    <img src="{{ static_asset('newfas/img/svg/customer-service.svg') }}" alt="">
                                                </div>
                                            </div>
                                            <div class="part-text">
                                                <h3 class="title">Member Support</h3>
                                                <p>We provide friendly support directly 
from your member dashboard. We're 
always responsible to take care</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- choosing reson end -->

            <!-- testimonial begin -->
            <div class="testimonial">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-8 col-lg-8">
                            <div class="section-title">
                                <span class="sub-title">
                                    Our Customer Feedback
                                </span>
                                <h2>
                                    Members Are <span class="special"> Giddy!</span>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="all-testimonials">
                        <div class="row justify-content-center">
                            <div class="col-xl-8 col-lg-8">
                                <div class="testi-text-slider">
                                    <div class="single-testimonial">
                                        <span class="quot-icon">
                                            <img src="{{ static_asset('newfas/img/icon/quot.png') }}" alt="">
                                        </span>
                                        <p>I love the simple straightforward dashboard. Ways to earn points are right there and I convert my points to money easily.</p>
                                        <div class="part-user">
                                            <span class="user-name"> Jacqueline</span>
                                            <span class="user-location">United States, US</span>
                                        </div>
                                    </div>

                                    <div class="single-testimonial">
                                        <span class="quot-icon">
                                            <img src="{{ static_asset('newfas/img/icon/quot.png') }}" alt="">
                                        </span>
                                        <p>Boomerdash brings a new and fresh feel. It is mind blowing that there 
is an actual real way to earn decent money online.</p>
                                        <div class="part-user">
                                            <span class="user-name">Sophia</span>
                                            <span class="user-location">United States, US</span>
                                        </div>
                                    </div>
                                    
<!--                                    <div class="single-testimonial">-->
<!--                                        <span class="quot-icon">-->
<!--                                            <img src="{{ static_asset('newfas/img/icon/quot.png') }}" alt="">-->
<!--                                        </span>-->
<!--                                        <p>Boomerdash brings a new and fresh feel. It is mind blowing that there -->
<!--is an actual real way to earn decent money online.</p>-->
<!--                                        <div class="part-user">-->
<!--                                            <span class="user-name">Sadwel Eunton</span>-->
<!--                                            <span class="user-location">London, UK</span>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="single-testimonial">-->
<!--                                        <span class="quot-icon">-->
<!--                                            <img src="{{ static_asset('newfas/img/icon/quot.png') }}" alt="">-->
<!--                                        </span>-->
<!--                                        <p>Boomerdash brings a new and fresh feel. It is mind blowing that there -->
<!--is an actual real way to earn decent money online.</p>-->
<!--                                        <div class="part-user">-->
<!--                                            <span class="user-name">Sadwel Eunton</span>-->
<!--                                            <span class="user-location">London, UK</span>-->
<!--                                        </div>-->
<!--                                    </div>-->

<!--                                    <div class="single-testimonial">-->
<!--                                        <span class="quot-icon">-->
<!--                                            <img src="{{ static_asset('newfas/img/icon/quot.png') }}" alt="">-->
<!--                                        </span>-->
<!--                                        <p>Boomerdash brings a new and fresh feel. It is mind blowing that there -->
<!--is an actual real way to earn decent money online.</p>-->
<!--                                        <div class="part-user">-->
<!--                                            <span class="user-name">Sadwel Eunton</span>-->
<!--                                            <span class="user-location">London, UK</span>-->
<!--                                        </div>-->
<!--                                    </div>-->
                                    

                                </div>
                                <div class="testi-user-slider">
                                    <!--<div class="single-user">-->
                                    <!--    <img src="{{ static_asset('newfas/img/testimonial.png') }}" alt="">-->
                                    <!--</div>-->
                                    <!--<div class="single-user">-->
                                    <!--    <img src="{{ static_asset('newfas/img/testimonia-2.png') }}" alt="">-->
                                    <!--</div>-->
                                    <!--<div class="single-user">-->
                                    <!--    <img src="{{ static_asset('newfas/img/testimonia-3.png') }}" alt="">-->
                                    <!--</div>-->
                                    <!--<div class="single-user">-->
                                    <!--    <img src="{{ static_asset('newfas/img/testimonial.png') }}" alt="">-->
                                    <!--</div>-->
                                    <!--<div class="single-user">-->
                                    <!--    <img src="{{ static_asset('newfas/img/testimonia-2.png') }}" alt="">-->
                                    <!--</div>-->
                                    <!--<div class="single-user">-->
                                    <!--    <img src="{{ static_asset('newfas/img/testimonia-3.png') }}" alt="">-->
                                    <!--</div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- testimonial end -->

            <!-- contact begin -->
            <div class="contact" id="contact">
                <div class="container container-contact">
                    <div class="row justify-content-center">
                        <div class="col-xl-8 col-lg-8">
                            <div class="section-title section-title-2">
                                <span class="sub-title">
                                    Contact Us
                                </span>
                                <h2>
                                    Get in touch<span class="special"> with us</span>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="bg-tamim">
                        <div class="row justify-content-around">
                            <div class="col-xl-6 col-lg-6 col-sm-10 col-md-6">
                                <div class="part-form">
                                
                                
                                    <!--<form>-->
                                    <!--    <input type="text" placeholder="Players Name">-->
                                    <!--    <input type="text" placeholder="Players Email">-->
                                    <!--    <textarea placeholder="Write to Us..."></textarea>-->
                                    <!--    <button class="submit-btn def-btn" type="submit">Submit</button>-->
                                    <!--</form>-->
                                
                                <form action="{{ route('send.email') }}" method="POST">
                                @csrf
                                <input type="text" name="player_name" placeholder="Players Name">
                                <input type="text" name="player_email" placeholder="Players Email">
                                <textarea name="message" placeholder="Write to Us..."></textarea>
                                <button class="submit-btn def-btn" type="submit">Submit</button>
                                </form>

                                
                                
                                
                                
                                </div>
                            </div>
                            <!--<div class="col-xl-4 col-lg-5 col-sm-10 col-md-6">-->
                            <!--    <div class="part-address">-->
                            <!--        <div class="addressing">-->
                            <!--            <div class="single-address">-->
                            <!--                <h4>Our Office</h4>-->
                            <!--                <p>1941 Romines Mill Road-->
                            <!--                    Irving, TX 75062<br/>Texas, United States</p>-->
                            <!--            </div>-->
                            <!--            <div class="single-address">-->
                            <!--                <h4>Email</h4>-->
                            <!--                <p>DanielleHButeau@teleworm.us<br/>-->
                            <!--                    CharlesTPride@armyspy.com</p>-->
                            <!--            </div>-->
                            <!--            <div class="single-address">-->
                            <!--                <h4>Phone</h4>-->
                            <!--                <p>+1 318-342-7639<br/>-->
                            <!--                    +1 530-259-4087</p>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                        </div>
                    </div>
                </div>
            </div>


@endsection
