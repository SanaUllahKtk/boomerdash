@extends('newf.layouts.app')
<style>
    .hero-section img {
        width: 100%;
        height: 70vh;
    }
</style>


<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />
<style>
    /* Product Card Styles */
.product-card {
    position: relative;
    width: 273px;
    height: 273px;
    overflow: hidden;
    margin: 10px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    text-align: center;
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
    background-color: rgba(0, 0, 0, 0.5); /* Black overlay */
    opacity: 0.5;
}

/* Title Styles */
.product-image h3 {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    z-index: 1;
    margin: 0;
    padding: 10px;
    text-align: center;
    width: 100%;
}

</style>
@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <!-- Hero Section -->
            <section class="hero-section">
                <img src="{{ uploaded_asset($post->photo) }}" alt="">
            </section>
        </div>
    </div>
    <div class="row" style="position: relative;">
        <div class="col-md-2"></div>
        <div class="col-md-8 mx-auto">
            <section class="post-content mt-1">
                <h2 class="text-center">{{ $post->title }}</h2>
                <div class="container">
                    {!! $post->content !!}
                </div>
            </section>


            <!-- Products Carousel Section -->
            <section class="products-carousel">
                <div class="container">
                    <h2 class="text-center mb-4">Highlights</h2>
                    <div class="slick-carousel" style="height: 274px;">

                        <!-- Product Cards -->
                        @forelse($posts as $post)
                            <div class="product-card">
                                <a href="{{ route('single_post', $post->slug) }}">
                                    <div class="product-image">
                                        <img src="{{ uploaded_asset($post->photo) }}" alt="Product 1 Image">
                                        <div class="overlay"></div>
                                        <h3>{{ $post->title }}</h3>
                                    </div>
                                </a>
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
        

        <div class="col-md-2">
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
                    <a href="{{ $ad->link }}" class="addClick" data-ad-id="{{ $ad->id }}">
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
        
        
        
        
        
        
        
        
        



        <div id="timer" class="text-right d-none"
            style="position: fixed; top: 100px; right: 20px; background-color: rgba(0, 0, 0, 0.5); color: white; padding: 10px; font-size: 16px; border-radius: 5px;">
        </div>

    </div>
@endsection

<script>
   var timerInterval;
var startTime;
var elapsedTime = 0;
var isPageVisible = true;

// Function to start the timer
function startTimer() {
    startTime = new Date().getTime() - elapsedTime;
    timerInterval = setInterval(updateTimer, 1000);
}

// Function to update the timer
function updateTimer() {
    var currentTime = new Date().getTime();
    elapsedTime = currentTime - startTime;

    var minutes = Math.floor((elapsedTime % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((elapsedTime % (1000 * 60)) / 1000);

    document.getElementById("timer").innerHTML = "Time Spent: " + minutes + "m " + seconds + "s";

    // Check if seconds reach the desired value
    if (seconds === {{ $post->timer }}) {
        // Clear the interval to stop the timer
        clearInterval(timerInterval);

        // AJAX call to send the ID to the route
        $.ajax({
            url: '{{ route('savePoints') }}',
            type: 'POST',
            data: {
                id: {{ $post->id }},
                points: {{ $post->points }}
            },
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log(response);
                if(response == 1){
                    toastr.success('You earned {{ $post->points }} points successfully.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Failed to save points:', error);
                // Handle error here
            }
        });
    }
}

// Function to pause the timer
function pauseTimer() {
    clearInterval(timerInterval);
}

// Event listener for page visibility change
document.addEventListener("visibilitychange", function() {
    if (document.visibilityState === 'hidden') {
        isPageVisible = false;
        pauseTimer();
    } else {
        isPageVisible = true;
        startTimer();
    }
});

// Call the startTimer function when the page is loaded
window.onload = startTimer;

</script>




    <!-- Slick JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.slick-carousel').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 3,
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


        });
    </script>
