@extends('newf.layouts.app')
<style>
    h2 {
        font-weight: 700;
    }

    /* Style for the card section */
    .card-section {
        padding: 20px;
        background-color: #f8f9fa;
        /* Light gray background */
    }

    /* Style for card title */
    .card-title {
        font-size: 16px;
        font-weight: bold;
    }

    /* Style for card date */
    .card-date {
        color: #6c757d;
        /* Gray color for date */
    }

    .card {
        heigth: 300px;
    }
</style>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
<style>
    /* Custom styles */
    .product-card {
        padding: 10px;
        text-align: center;
    }

    .product-card {
        width: 273px;
        height: 273px;
    }


    /* Product Card Styles */
    .product-card {
        position: relative;
        overflow: hidden;
        margin: 10px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    /* Product Image Styles */
    .product-image {
        position: relative;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        display: block;
        border-radius: 8px;
    }

    /* Overlay Styles */
    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        /* Black overlay */
        opacity: 0.5;
    }

    .product-content {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 40%;
        color: #fff;
    }
</style>
@section('content')
    <style>
        .categories {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            border-bottom: 1px solid #ccc;
            /* Add border between options */
            padding: 10px 0;
            /* Add padding for spacing */
        }

        .categories>div {
            flex: 1;
            text-align: center;
        }

        .categories>div:not(:last-child) {
            margin-right: 10px;
            /* Add margin between options */
        }

        .categories a {
            text-decoration: none;
            color: #333;
            display: block;
            padding: 5px 0;
            transition: color 0.3s ease;
        }

        .categories a:hover {
            color: #007bff;
            /* Change color on hover */
        }
    </style>

    <div class="categories container" style="padding-left: 10px; padding-right: 10px;">
        <div>
            <a href="/allposts" class="">All</a>
        </div>
        @forelse($categories as $key => $cat)
        <div>
            <a href="/allposts?cat_id={{$key}}" class="">{{ $cat }}</a>
        </div>
        @empty 
        @endforelse
    </div>


    <!-- Hero Section -->
    <section class="hero-section"
        style="position: relative; height: 70vh; display: flex; justify-content: center; align-items: center;">
        <img src="{{ uploaded_asset($page->banner ?? '') }}" alt=""
            style="position: absolute; width: 100%; height: 100%; object-fit: cover; z-index: 1;">

        <div class="overlay"
            style="
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 1);
        z-index: 2;
    ">
        </div>
        <div style="position: relative; z-index: 3; text-align: center; color: white;">
            <h2>{{ $page->heading1 }}</h2>
            <p>{{ $page->sub_heading }}</p>
        </div>
    </section>


    <div class="row" style="background: #f8f9fa">
        <div class="col-md-10">
            <!-- Blogs Section -->
            <section class="card-section">
                <div class="container">
                    <h2 class="text-center mb-4">Discover Stories</h2>
                    <div class="row">
                        @forelse($posts as $post)
                            <!-- Blog Cards -->

                            <div class="col-md-3 mb-4">
                                <a href="{{ route('single_post', $post->slug) }}">
                                    <div class="card">
                                        <img src="{{ uploaded_asset($post->photo) }}" class="card-img-top" alt="Blog Image" width="100%" height="150px">
                                        <div class="card-body" style="height: 150px !important;">
                                            <h5 class="card-title">
                                                @if(strlen($post->title) > 100)
                                                    {{ substr($post->title, 0, 100) . '...' }}
                                                @else
                                                    {{ $post->title }}
                                                @endif
                                            </h5>
                                        </div>
                                        <div class="card-footer text-center" style="background-color: white; color: purple; position: relative; display: flex; padding: 0px !important;">
                                            <img src="{{ static_asset('logo.png') }}" alt="" class="" width="80px" style="padding: 0px !important;">
                                            <span style="position: absolute; left: 4rem; top: 29px;">Earn {{ $post->points ?  number_format($post->points, 2) : '0.00' }} Points</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            

                        @empty
                            <div class="12">
                                <h3 class="text-center">No Discover Stories Found !!!</h3>
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>

            <!-- Latest Blog Section -->
            <section class="card-section">
                <div class="container">
                    <h2 class="text-center mb-4">Highlights</h2>
                    <div class="row">
                        @forelse($latest_posts as $post)
                            <!-- Blog Cards -->
                            <div class="col-md-3 mb-4">
                                <a href="{{ route('single_post', $post->slug) }}">
                                    <div class="card">
                                        <img src="{{ uploaded_asset($post->photo) }}" class="card-img-top" alt="Blog Image"
                                            width="100%" height="150px">
                                        <div class="card-body" style="height: 150px !important;">
                                            <h5 class="card-title">
                                                @if(strlen($post->title) > 100)
                                                    {{ substr($post->title, 0, 100) . '...' }}
                                                @else
                                                    {{ $post->title }}
                                                @endif
                                            </h5>
                                        </div>

                                        <div class="card-footer text-center" style="background-color: white; color: purple; position: relative; display: flex; padding: 0px !important;">
                                            <img src="{{ static_asset('logo.png') }}" alt="" class="" width="80px" style="padding: 0px !important;">
                                            <span style="position: absolute; left: 4rem; top: 29px;">Earn {{ $post->points ?  number_format($post->points, 2) : '0.00' }} Points</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="12">
                                <h3 class="text-center">No Highlights Found !!!</h3>
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-2 card-section">

            <h2 class="" style="visibility: hidden">Blog</h2>
            @forelse($ads as $ad)
                @php 
                    $randomValue = rand(0, 1);
                @endphp

                @if($randomValue == 0)
                    <a href="{{ $ad->link }}" class="addClick" data-ad-id="{{ $ad->id }}" target="_blank" style="display: block; border: 1px solid #ccc; padding: 5px; border-radius: 5px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1); margin-top: 1rem;">
                        <img src="{{ uploaded_asset($ad->photo ) }}" alt="Advertisement" style="width: 100%; height: auto;">
                        <small class="text-dark">{{ $ad->title }}</small>
                    </a>
                @else 
                    <a href="{{ $ad->link }}" class="addClick" target="_blank"  data-ad-id="{{ $ad->id }}">
                        <video autoplay loop muted playsinline style="display: block; margin-top: 10px; width: 100%; border-radius: 5px; box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1); margin-top: 1rem;">
                            <source src="{{ static_asset($ad->video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <small class="text-dark">{{ $ad->title }}</small>
                    </a>
                @endif


            @empty 

            @endforelse
        </div>
    </div>




    <!-- Products Carousel Section -->
    <section class="products-carousel d-none">
        <div class="container">
            <h2 class="text-center mb-4">Products</h2>
            <div class="slick-carousel" style="height: 274px;">

                <!-- Product Cards -->
                @forelse($products as $product)
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{ uploaded_asset($product->thumbnail_img) }}" alt="Product 1 Image">
                            <div class="overlay"></div>

                            <div class="product-content">
                                <h3>{{ $product->name }}</h3>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="">
                        <h2>No Product Found</h2>
                    </div>
                @endforelse
            </div>
        </div>
    </section>




    <!-- Slick JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.slick-carousel').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                responsive: [{
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });
        });


        $(document).on("click", '.addClick' ,function() {
                var ad_id = $(this).data('ad-id');
                $.ajax({
                    method: 'GET',
                    url: '/clickscount/' + ad_id,
                    success: function(data) {
                        // Handle success response here
                    },
                    error: function(xhr, status, error) {
                        // Handle error response here
                    }
                });
            });
    </script>
@endsection
