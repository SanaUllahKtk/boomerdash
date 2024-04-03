@extends('frontend.layouts.app')

@section('content')
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-2"></div>
                <div class="col-md-8 bg-white">
                    <div class="aiz-user-panel card">
                        <div class="card-header d-flex justify-content-between">
                            <h3>Most Popular Posts</h3>
                            
                            @if(\Auth::user()->isCreatePost == 1)
                            <div class="creat-post">
                                <a href="{{ route('r_mobile_posts.create') }}" class="btn btn-primary">Create Post</a>
                            </div>
                            @endif
                        </div>

                        <div class="card-body">
                            @forelse ($posts as $post)
                                @php 
                                    $product = \App\Models\RProduct::where('id', $post->productId)->first(); 
                                    if(!$product)
                                        continue;
                                @endphp 

                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <div class="d-flex">
                                            <div class="profile" style="position: relative; display: flex;">
                                                <i class="las la-user-circle mx-1" style="font-size: 60px;"></i>
                                               
                                                <div class="">
                                                    <span style="font-weight: bold; font-size: 20px;">{{ ucfirst($users[$post->user_id] ?? '') }}</span> <small>{{ $post->created_at->diffForHumans() }}</small> <br> {{ ucfirst($brands[$post->brandId] ?? '') }}
                                                </div>
                                            </div>
                                        </div>

                                        <a href="{{ route('r_mobile_posts.show', [$post->id]) }}">
                                            <h4>{{ $product->title }}</h4>
                                        </a>

                                        <div class="">
                                            @if (pathinfo($post->img, PATHINFO_EXTENSION) === 'mp4')
                                                <video width="100%" height="auto" autoplay loop muted style="border: 1px solid #ccc; border-radius: 10px;">
                                                    <source src="{{ uploaded_asset($post->img) }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                        
                                            @else
                                            <style>
                                                /* Default style */
                                                .post-image {
                                                    width: 800px;
                                                    height: 600px;
                                                    object-fit: cover;
                                                    border: 1px solid #ccc;
                                                    border-radius: 10px;
                                                }
                                            
                                                /* Media query for smaller screens */
                                                @media (max-width: 767px) {
                                                    .post-image {
                                                        max-width: 100%;
                                                        height: auto;
                                                    }
                                                }
                                            </style>
                                            
                                            <!-- HTML -->
                                            <img src="{{ uploaded_asset($post->img) }}" alt="Post Image" class="post-image">
                                                                                                                           
                                            @endif
                                        </div>

                                        <div class="row mx-1" style="background: #e2e5ec;">
                                            <div class="col-md-8 d-flex justify-content-between justify-content-md-start">
                                                <div class="my-auto">
                                                    <img src="{{ uploaded_asset($product->img) }}" alt="Product Image" style="max-height: 75px;" class="img-fluid">
                                                </div>
                                                <div class="mx-2 my-auto">
                                                    <h5><b>{{ $product->title }}</b></h5>
                                                    @if ($product->url)
                                                    <div class="">
                                                        @php
                                                            $url = $product->url;
                                                            if (strpos($url, 'https://') !== 0) {
                                                                $url = 'https://' . $url;
                                                            }
                                                        @endphp
                                                        <a href="{{ $url }}" target="_blank" class="postUrl text-dark" id="postUrl" onclick="updateClick({{ $post->id }})" data-post-id="{{ $post->id }}">{{ $url }}</a>
                                                    </div>
                                                @endif
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-md-4 d-flex justify-content-between justify-content-md-start">
                                                @if(!empty($post->brandId))
                                                    @php 
                                                        $brand = \App\Models\Brand::findOrFail($post->brandId);
                                                    @endphp
                                                    
                                                    <div class="my-auto">
                                                        <img src="{{ uploaded_asset($brand->logo) }}" alt="Brand Image" class="img-fluid" style="max-height: 70px;">
                                                    </div>
                                                    <div class="mx-2 my-auto">
                                                        <h5><b>{{ $brand->name }}</b></h5>
                                                    </div>
                                                @endif 
                                            </div>
                                        </div>
                                        <p>{!! \Illuminate\Support\Str::words($product->description, 10) !!}</p>

                                        <!-- Icons -->
                                        <div class="mt-2">
                                            @php 
                                                $vote = \App\Models\RPostVote::where('r_post_id', $post->id)->where('r_user_id', \Auth::user()->id)->first();
                                            @endphp 
                                            <a href="javascript:void(0)"
                                                class="mr-3 btn btn-sm {{ isset($vote->vote) && $vote->vote == 1 ? 'bg-primary' : 'bg-success' }} text-white upvote-btn"
                                                style="font-size: 16px;" data-post-id="{{ $post->id }}"><i
                                                    class="las la-arrow-circle-up"></i><span class="upVoteSpan">{{ \App\Models\RPostVote::where('vote', 1)->where('r_post_id', $post->id)->count() }}</span></a>
                                            
                                            <a href="javascript:void(0)"
                                                class="mr-3 btn btn-sm d-none {{ isset($vote->vote) && $vote->vote == 0 ? 'bg-primary' : 'bg-success' }} text-white downvote-btn"
                                                style="font-size: 16px;" data-post-id="{{ $post->id }}"><i
                                                    class="las la-arrow-circle-down"></i>
                                                <span class="downVoteSpan">{{ \App\Models\RPostVote::where('vote', 0)->where('r_post_id', $post->id)->count() }} </span></a>
                                            <a href="{{ route('r_posts.show', [$post->id]) }}" class="mr-3 btn btn-sm bg-success text-white"
                                                style="font-size: 16px;"><i class="las la-comments"></i>
                                                {{ \App\Models\RComment::where('post_id', $post->id)->count() }}</a>
                                            <a href="{{ route('r_posts.show', [$post->id]) }}"
                                                class="mr-3 btn btn-sm bg-success text-white"
                                                style="font-size: 16px;"><i class="las la-flag"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                            @empty 
                                <div class="row">
                                    <div class="col-12">
                                         <h3 class="text-center">No Post Found !!!</h3>
                                    </div>
                                </div>
                            @endforelse

                        </div>
                    </div>

                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(".upvote-btn").on("click", function() {
            var post_id = $(this).data('post-id');
            var current_btn = $(this);

            $.ajax({
                method: 'GET',
                url: '{{ route('upVote', ':post_id') }}'.replace(':post_id', post_id),
                success: function(response) {
                    response = JSON.parse(response);
                    $(".upVoteSpan").html(response.total);

                    if(current_btn.hasClass('bg-success')){
                        current_btn.removeClass('bg-success');
                        current_btn.addClass('bg-primary');
                    }else{
                        current_btn.removeClass('bg-primary');
                        current_btn.addClass('bg-success');
                    }
                }
            });
        });


        $(".downvote-btn").on("click", function() {
            var post_id = $(this).data('post-id');

            $.ajax({
                method: 'GET',
                url: '{{ route('downVote', ':post_id') }}'.replace(':post_id', post_id),
                success: function(response) {
                    response = JSON.parse(response);
                    $(".downVoteSpan").html(response.total);
                }
            });
        })

       
       function updateClick(id){
            var postId = id;
            $.ajax({
                method: 'GET',
                url: '/updateUrlCicks?postId=' + postId,
                success: function(data) {

                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    </script>
@endsection
