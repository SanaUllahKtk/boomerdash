@extends('frontend.layouts.app')

@section('content')
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-3">
                    @include('frontend.inc.user_side_nav')
                </div>

                <div class="col-md-9">
                    <div class="aiz-user-panel">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ $post->title }}</h4>
                            </div>

                            <div class="card-body">
                                @if (session('message'))
                                    <div class="alert alert-info">{{ session('message') }}</div>
                                @endif

                                @if ($post->url)
                                    <div class="mb-2">
                                        <a href="{{ $post->url }}" target="_blank" class="postUrl" id="postUrl"
                                            data-post-id={{ $post->id }}>{{ $post->url }}</a>
                                    </div>
                                @endif

                                @if ($post->img)
                                    <div class="">
                                        @if (pathinfo($post->img, PATHINFO_EXTENSION) === 'mp4')
                                            <video width="100%" height="400px" autoplay loop muted
                                                style="border: 1px solid #ccc; border-radius: 10px;">
                                                <source src="{{ static_asset($post->img) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        @else
                                            <img src="{{ static_asset($post->img) }}" alt="Post Image"
                                                style="width: 100%; max-height: 540px; border: 1px solid #ccc; border-radius: 10px;">
                                        @endif
                                    </div>
                                    <br /><br />
                                @endif

                                {!! $post->description !!}

                                @auth
                                    <hr />
                                    <h3>Comments</h3>
                                    @forelse ($post->comments as $comment)
                                        <div class="comment-container d-flex justify-content-between">
                                            <div class="comment">
                                                <b>{{ $comment->user->name }}</b>
                                                <br />
                                                {{ $comment->created_at->diffForHumans() }}
                                                <p class="mt-2">{{ $comment->description }}</p>
                                            </div>

                                            <div class="comment-action">
                                                <div class="dropdown">
                                                    <style>
                                                        .dropdown-toggle::after {
                                                            margin-bottom: 1rem;
                                                        }
                                                    </style>
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item"
                                                            href="{{ route('r_comments.destroy', $comment) }}">Delete
                                                            Comment</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        No comments yet.
                                    @endforelse

                                    <hr />
                                    <form method="POST" action="{{ route('r_comments.store') }}">
                                        @csrf
                                        Add a comment:
                                        <br />
                                        <input type="hidden" value="{{ $post->id }}" name="post_id">
                                        <textarea class="form-control" name="comment_text" rows="5" required></textarea>

                                        @error('comment_text')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <br />
                                        <button type="submit" class="btn btn-sm btn-primary">Add Comment</button>
                                    </form>

                                    <hr />

                                    @if (\Auth::user()->id == $post->user_id)
                                        <a href="{{ route('r_posts.edit', ['r_post' => $post]) }}"
                                            class="btn btn-sm btn-primary">Edit
                                            post</a>



                                        <form action="{{ route('r_posts.destroy', ['r_post' => $post]) }}"
                                            method="POST" style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">Delete post</button>
                                        </form>

                                        <!-- Button trigger modal -->
                                        <button type="button" data-post-id="{{ $post->id }}" id="showModal" class="btn btn-sm btn-primary" data-toggle="modal"
                                            data-target="#reportModal">
                                            Report
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="reportModal" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Report</h5>
                                                        <button type="button"class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('r_reports.store') }}" method="POST">
                                                    <div class="modal-body">
                                                         @csrf
                                                            <div class="form-group">
                                                                <label for="">Report Type</label>
                                                                <select name="type" id="" class="form form-control">
                                                                       <option value="">Select Type</option>
                                                                       <option value="spam">Spam</option>
                                                                       <option value="inappropriate">Inappropriate</option> 
                                                                </select>
                                                                <input type="hidden" value="" name="postId" id="postId">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">Description</label>
                                                                <textarea name="description" class="form form-control" id="" cols="10" rows="3"></textarea>
                                                            </div>
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    {{-- <form action="{{ route('post.report', $post->id) }}" method="POST"
                                        style="display: inline-block">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure?')">Report post as inappropriate</button>
                                    </form> --}}
                                @endauth
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
        $("#postUrl").on("click", function() {
            var postId = $(this).data('post-id');
            $.ajax({
                method: 'GET',
                url: '/updateUrlCicks?postId=' + postId,
                success: function(data) {

                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

        })

        $("#showModal").on("click", function(){
            $("#postId").val($(this).data('post-id'));
        })
    </script>
@endsection
