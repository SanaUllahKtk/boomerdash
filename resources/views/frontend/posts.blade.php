@extends('frontend.layouts.app')
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
        font-size: 14px;
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
    <section class="py-5">
        <div class="container">
            <div class="d-flex align-items-start">
                @include('frontend.inc.user_side_nav')

                <div class="aiz-user-panel">
                    <div class="card">
                        <div class="card-body">
                            <!-- Hero Section -->
                            <section class="hero-section"
                                style="position: relative; height: 50vh; display: flex; justify-content: center; align-items: center;">
                                <img src="{{ uploaded_asset($page->banner ?? '') }}" alt=""
                                    style="position: absolute; width: 100%; height: 100%; object-fit: cover; min-height: 50vh;">

                                <div class="overlay"
                                    style="
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 0;
">
                                </div>
                                <div style="position: relative; z-index: 1; text-align: center; color: white;">
                                    <h2>{{ $page->heading1 }}</h2>
                                    <p>{{ $page->sub_heading }}</p>
                                </div>
                            </section>


                            <!-- Blogs Section -->
                            <section class="card-section">
                                <div class="container">
                                    <h2 class="text-center mb-4">Blogs</h2>
                                    <div class="row">
                                        @forelse($posts as $post)
                                            <!-- Blog Cards -->

                                            <div class="col-md-4 mb-4">
                                                <a href="{{ route('single_post_mobile', $post->id) }}">
                                                    <div class="card">
                                                        <img src="{{ uploaded_asset($post->photo) }}" class="card-img-top"
                                                            alt="Blog Image" width="100%" height="200px">
                                                        <div class="card-body" style="height: 150px !important;">
                                                            <h5 class="card-title">{{ $post->title }}</h5>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>

                                        @empty
                                            <div class="12">
                                                <h3 class="text-center">No Blog Found !!!</h3>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </section>

                            <!-- Latest Blog Section -->
                            <section class="card-section">
                                <div class="container">
                                    <h2 class="text-center mb-4">Latest Blog</h2>
                                    <div class="row">
                                        @forelse($latest_posts as $post)
                                            <!-- Blog Cards -->
                                            <div class="col-md-4 mb-4">
                                                <a href="{{ route('single_post_mobile', $post->id) }}">
                                                    <div class="card">
                                                        <img src="{{ uploaded_asset($post->photo) }}" class="card-img-top"
                                                            alt="Blog Image" width="100%" height="200px">
                                                        <div class="card-body" style="height: 150px !important;">
                                                            <h5 class="card-title">{{ $post->title }}</h5>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @empty
                                            <div class="12">
                                                <h3 class="text-center">No Blog Found !!!</h3>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </section>

                            <!-- Products Carousel Section -->
                            <section class="products-carousel d-none">
                                <div class="container">
                                    <h2 class="text-center mb-4">Products</h2>
                                    <div class="slick-carousel" style="height: 274px;">

                                        <!-- Product Cards -->
                                        @forelse($products as $product)
                                            <div class="product-card">
                                                <div class="product-image">
                                                    <img src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                        alt="Product 1 Image">
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


                        </div>

                    </div>
                </div>
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
    </script>
@endsection
