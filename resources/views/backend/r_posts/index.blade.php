@extends('backend.layouts.app')


@section('content')
    @php 
    $products = \App\Models\RProduct::pluck('title', 'id')->toArray();
    $brands = \App\Models\Brand::pluck('name', 'id')->toArray();
    @endphp 
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="h3">{{ translate('All Posts') }}</h1>
            </div>
        </div>
    </div>
    <br>


    <div class="card">
        <form class="" id="sort_stores" action="" method="GET">
            <div class="card-header row gutters-5">
                <div class="col">
                    <h5 class="mb-md-0 h6">{{ translate('All Posts') }}</h5>
                </div>

                <div class="dropdown mb-2 mb-md-0">
                    <button class="btn border dropdown-toggle" type="button" data-toggle="dropdown">
                        {{ translate('Bulk Action') }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#" onclick="bulk_delete()">
                            {{ translate('Delete selection') }}</a>
                    </div>
                </div>
            </div>
        </form>



        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                    <tr>
                        <th>
                            <div class="form-group">
                                <div class="aiz-checkbox-inline">
                                    <label class="aiz-checkbox">
                                        <input type="checkbox" class="check-all">
                                        <span class="aiz-square-check"></span>
                                    </label>
                                </div>
                            </div>
                        </th>

                        <th>{{ translate('Title') }}</th>
                        <th>{{ translate('Brand') }}</th>
                        <th>{{ translate('Product') }}</th>
                        <th>{{ translate('Upvote') }}</th>
                        <th>{{ translate('Url Clicks') }}</th>
                        <th>{{ translate('Comments') }}</th>
                        <th>{{ translate('Action') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($posts as $post)
                        <tr>
                            <td>
                                <div class="form-group d-inline-block">
                                    <label class="aiz-checkbox">
                                        <input type="checkbox" class="check-one" name="id[]"
                                            value="{{ $post->id }}">
                                        <span class="aiz-square-check"></span>
                                    </label>
                                </div>
                            </td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $brands[$post->brandId] ?? ''}}</td>
                            <td>{{ $products[$post->productId] ?? ''}}</td>
                            <td>
                                @php 
                                    $postUpVote = \App\Models\RPostVote::where('r_post_id', $post->id)->where('vote', 1)->count();
                                @endphp 
                                {{ $postUpVote }}
                            </td>

                            <td>
                                @php 
                                    $postClicks = \App\Models\RPostUrlClick::where('postId', $post->id)->count();
                                @endphp 
                                {{ $postClicks }}
                            </td>

                            <td>
                                @php 
                                    $comments = \App\Models\RComment::where('post_id', $post->id)->count();
                                @endphp 
                                <a href="{{ route('r_mobile_posts.show', $post->id) }}" class="">{{ $comments }}</a>
                            </td>

                            <td>
                                @if (\Auth::user()->user_type == 'admin')
                                    
                                    <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                        id="confirm-delete"
                                        data-post-id="{{ $post->id }}"
                                        data-url="{{ route('r_posts.destroy', ['r_post' => $post]) }}"
                                        title="{{ translate('Delete') }}">
                                        <i class="las la-trash"></i>
                                    </a>
                                @endif



                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection


@section('script')
    <script>
        $(document).on("change", ".check-all", function() {
            if (this.checked) {
                // Iterate each checkbox
                $('.check-one:checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('.check-one:checkbox').each(function() {
                    this.checked = false;
                });
            }

        });


        function bulk_delete() {
            var selectedIds = [];
            $('.check-one:checked').each(function() {
                selectedIds.push($(this).val());
            });

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('bulk-posts-delete') }}",
                type: 'POST',
                data: {
                    ids: selectedIds
                }, // Pass selectedIds array as data
                success: function(response) {
                    if (response == 1) {
                        location.reload();
                    }
                }
            });
        }

        $(document).ready(function() {
          // Attach a click event handler to the delete button
            $(document).on("click","#confirm-delete", function(e) {
                e.preventDefault(); // Prevent the default link behavior

                var storeId = $(this).data("store-id"); // Get the product ID from the data attribute
                var deleteUrl = $(this).data("url"); // Get the DELETE URL from the data attribute

                // Show a confirmation dialog
                if (confirm("Are you sure you want to delete this post?")) {
                    // Send a DELETE request to delete the product
                    $.ajax({
                        type: "DELETE",
                        url: deleteUrl,
                        data: {
                            _token: "{{ csrf_token() }}",
                            admin: 'admin'
                        },
                        success: function(response) {
                            // Handle the success response here (e.g., reload the page or remove the deleted element)
                            alert("Post deleted successfully");
                            location.reload(); // Reload the page
                        },
                        error: function(error) {
                            // Handle any errors here
                            alert("Error deleting post");
                        }
                    });
                }
            });
        });
    </script>
@endsection
