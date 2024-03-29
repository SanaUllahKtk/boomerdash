@extends('frontend.layouts.app')

@section('content')
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('frontend.inc.user_side_nav')
                </div>

                <div class="col-md-9">
                    <div class="aiz-user-panel card">
                        <div class="card-header d-flex justify-content-between">
                            <h3>Most Popular Posts</h3>
                            
                            <div class="creat-post">
                                <a href="{{ route('r_posts.create') }}" class="btn btn-primary">Create Post</a>
                            </div>
                        </div>

                        <div class="card-body">
                            @forelse ($posts as $post)
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <div class="d-flex">
                                            <div class="profile" style="position: relative; display: flex;">
                                                <i class="las la-user-circle" style="font-size: 60px;"></i>
                                               
                                                <div class="">
                                                    <span style="font-weight: bold; font-size: 20px;">{{ ucfirst($users[$post->user_id] ?? '') }}</span> <small>{{ $post->created_at->diffForHumans() }}</small> <br> {{ ucfirst($categories[$post->r_category_id ?? '']) }}
                                                </div>
                                            </div>
                                        </div>


                                        <a href="{{ route('r_posts.show', [$post->id]) }}">
                                            <h2>{{ $post->title }}</h2>
                                        </a>

                                        <div class="">
                                            @if (pathinfo($post->img, PATHINFO_EXTENSION) === 'mp4')
                                            <video width="100%" height="400px" autoplay loop muted style="border: 1px solid #ccc; border-radius: 10px;">
                                                <source src="{{ static_asset($post->img) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                        
                                            @else
                                            <img src="{{ static_asset($post->img) }}" alt="Post Image"
                                            style="width: 100%; max-height: 540px; border: 1px solid #ccc; border-radius: 10px;">                                       
                                            @endif
                                        </div>
                                        <p>{!! \Illuminate\Support\Str::words($post->description, 10) !!}</p>

                                        <!-- Icons -->
                                        <div class="mt-2">
                                            <a href="javascript:void(0)"
                                                class="mr-3 btn btn-sm bg-success text-white upvote-btn"
                                                style="font-size: 16px;" data-post-id="{{ $post->id }}"><i
                                                    class="las la-arrow-circle-up"></i><span class="upVoteSpan">{{ \App\Models\RPostVote::where('vote', 1)->where('r_post_id', $post->id)->count() }}</span></a>
                                            <a href="javascript:void(0)"
                                                class="mr-3 btn btn-sm bg-success text-white downvote-btn"
                                                style="font-size: 16px;" data-post-id="{{ $post->id }}"><i
                                                    class="las la-arrow-circle-down"></i>
                                                <span class="downVoteSpan">{{ \App\Models\RPostVote::where('vote', 0)->where('r_post_id', $post->id)->count() }} </span></a>
                                            <a href="javascript:void(0)" class="mr-3 btn btn-sm bg-success text-white d-none"
                                                style="font-size: 16px;"><i class="las la-comments"></i>
                                                {{ \App\Models\RComment::where('post_id', $post->id)->count() }}</a>
                                            <a href="javascript:void(0)"
                                                class="mr-3 btn btn-sm bg-success text-white d-none"
                                                style="font-size: 16px;"><i class="las la-share-square"></i></a>
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
            </div>
        </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(".upvote-btn").on("click", function() {
            var post_id = $(this).data('post-id');

            $.ajax({
                method: 'GET',
                url: '{{ route('upVote', ':post_id') }}'.replace(':post_id', post_id),
                success: function(response) {
                    response = JSON.parse(response);
                    $(".upVoteSpan").html(response.total);
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
    </script>
@endsection
