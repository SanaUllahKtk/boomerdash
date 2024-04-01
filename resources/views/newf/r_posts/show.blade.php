@extends('frontend.layouts.app')

@section('content')
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @php 
    $product = \App\Models\RProduct::where('id', $post->productId)->first(); 
  
@endphp
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                {{-- <div class="col-md-3">
                    @include('frontend.inc.user_side_nav')
                </div> --}}

                <div class="col-md-9">
                    <div class="aiz-user-panel">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ $product->title }}</h4>
                            </div>

                            <div class="card-body">
                                @if (session('message'))
                                    <div class="alert alert-info">{{ session('message') }}</div>
                                @endif

                                @if ($product->url)
                                    <div class="mb-2">
                                        <a href="{{ $product->url }}" target="_blank" class="postUrl" id="postUrl"
                                            data-post-id={{ $post->id }}>{{ $product->url }}</a>
                                    </div>
                                @endif

                                @if ($product->img)
                                    <div class="row">
                                        <div class="col-12">
                                        @if (pathinfo($product->img, PATHINFO_EXTENSION) === 'mp4')
                                            <video width="100%" height="400px" autoplay loop muted
                                                style="border: 1px solid #ccc; border-radius: 10px;">
                                                <source src="{{ uploaded_asset($post->img) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        @else
                                            <img src="{{ uploaded_asset($post->img) }}" alt="Post Image"
                                                style="width: 100%; max-height: 540px; border: 1px solid #ccc; border-radius: 10px;">
                                        @endif
                                    </div>
                                    </div>
                                    <br /><br />
                                @endif

                                <div class="row">
                                    <div class="col-12">
                                        {!! $product->description !!}
                                    </div>
                                </div>


                                <h4>Feature</h4>
                                <div class="row mx-1" style="background: #e2e5ec;">
                                    <div class="col-md-8 d-flex">
                                        <div class="">
                                            <img src="{{ uploaded_asset($product->img) }}" alt="Product Image" width="100">
                                        </div>
                                        <div class="mx-2 my-auto">
                                            <h5><b>{{ $product->title }}</b></h5>
                                            @if(!empty($product->url))
                                                <a href="{{ $product->url }}" target="_blank" class="text-dark">{{ $product->url }}</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex">
                                        @php 
                                            $brand = \App\Models\Brand::findOrFail($post->brandId);
                                        @endphp
                                        
                                        <div class="">
                                            <img src="{{ uploaded_asset($brand->logo) }}" alt="Brand Image" width="100" height="100">
                                        </div>
                                        <div class="mx-2 my-auto">
                                            <h5><b>{{ $brand->name }}</b></h5>
                                        </div>

                                    </div>
                                </div>

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
                                        {{-- <a href="{{ route('r_mobile_posts.edit', ['r_mobile_post' => $post]) }}"
                                            class="btn btn-sm btn-primary">Edit
                                            post</a> --}}



                                        <form action="{{ route('r_mobile_posts.destroy', ['r_mobile_post' => $post]) }}"
                                            method="POST" style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">Delete post</button>
                                        </form>

                                    @endif

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
