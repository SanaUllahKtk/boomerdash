
@extends('newf.layouts.app')
@section('content')

<div class="contact contact-page" id="contact">
                <div class="container container-contact">
                    <div class="row justify-content-center">
                        <div class="col-xl-8 col-lg-8">
                            <div class="section-title">
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
                            <!--<div class="col-xl-4 col-lg-4 col-sm-10 col-md-6">-->
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
            <!-- contact end -->

            <!-- map begin -->
            <!--<div class="map">-->
            <!--    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d429269.42211006227!2d-97.56951529779923!3d32.801078234321494!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x864e6e122dc807ad%3A0xa4af8bf8dd69acbd!2sFort%20Worth%2C%20TX%2C%20USA!5e0!3m2!1sen!2sbd!4v1602530476004!5m2!1sen!2sbd" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>-->
            <!--</div>-->

@endsection
