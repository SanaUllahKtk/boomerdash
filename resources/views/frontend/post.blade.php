@extends('frontend.layouts.app')
<style>
    /*.hero-section img {*/
    /*    width: 100%;*/
    /*    height: 70vh;*/
    /*}*/
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
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('frontend.inc.user_side_nav')
            </div>
            <div class="col-md-9">
                <div class="aiz-user-panel">
                    <div class="card">
                        <div class="card-body">
                            <!-- Hero Section -->
                            <section class="hero-section">
                                <img src="{{ uploaded_asset($post->photo) }}" alt="" class="img-fluid" width="100%" height="70vh">
                            </section>

                            <!-- Post Content Section -->
                            <section class="post-content mt-3">
                                <div class="container">
                                    <h5 class="text-center"><strong>{{ $post->title }}</strong></h5>
                                    {!! $post->content !!}
                                </div>
                            </section>

                            <!-- Products Carousel Section -->
                            <section class="products-carousel mt-3">
                                <div class="container">
                                    <h2 class="text-center mb-4">Highlights</h2>
                                    <div class="slick-carousel">
                                        <!-- Product Cards -->
                                        @forelse($posts as $post)
                                            <div class="product-card">
                                                <a href="{{ route('single_post', $post->slug) }}">
                                                    <div class="product-image">
                                                        <img src="{{ uploaded_asset($post->photo) }}" alt="Product Image" class="img-fluid">
                                                        <div class="overlay"></div>
                                                        <h3>{{ $post->title }}</h3>
                                                    </div>
                                                </a>
                                            </div>
                                        @empty
                                            <div class="text-center">
                                                <h2>No Discover Stories Found</h2>
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
    </div>
</section>
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
        });
    </script>
