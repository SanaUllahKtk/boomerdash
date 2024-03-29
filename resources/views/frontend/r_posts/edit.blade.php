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
                    <div class="aiz-user-panel">
                        <div class="card">
                            <div class="card-header">
                                <h3>Edit Post</h3>
                                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="post-tab" data-toggle="tab" href="#post"
                                            role="tab" aria-controls="post" aria-selected="true">Post</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="media-tab" data-toggle="tab" href="#media" role="tab"
                                            aria-controls="media" aria-selected="false">Image and Video</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="link-tab" data-toggle="tab" href="#link" role="tab"
                                            aria-controls="link" aria-selected="false">Link</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('r_posts.update', ['r_post' => $r_post]) }}"
                                    id="post-form">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Content for Post tab -->
                                            <div class="form-group">
                                                <label for="post-title">Title</label>
                                                <input type="text"
                                                    class="form-control @error('post_title') is-invalid @enderror"
                                                    id="post-title" name="post_title" placeholder="Enter title"
                                                    value="{{ old('post_title', $r_post->title) }}">
                                                @error('post_title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="post-category">Category</label>
                                            <select name="categoryId" id="category"
                                                class="form form-control @error('categoryId') is-invalid @enderror">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $key => $category)
                                                    <option value="{{ $key }}"
                                                        @if (old('categoryId', $r_post->category_id) == $key) selected @endif>
                                                        {{ $category }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('categoryId')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="post" role="tabpanel"
                                            aria-labelledby="post-tab">
                                            <!-- Content for Post tab -->
                                            <div class="form-group">
                                                <label for="post-description">Description</label>
                                                <textarea class="aiz-text-editor form-control @error('post_description') is-invalid @enderror" id="post-description"
                                                    name="post_description" rows="3" placeholder="Enter description">{{ old('post_description', $r_post->description) }}</textarea>
                                                @error('post_description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="media" role="tabpanel" aria-labelledby="media-tab">
                                            <!-- Content for Image and Video tab -->
                                            <div id="dropzone-container" class="dropzone">
                                                <div class="dz-preview dz-complete dz-image-preview">
                                                    <?php
                                                    $file_extension = pathinfo($r_post->img, PATHINFO_EXTENSION);
                                                    if ($file_extension === 'mp4'):
                                                    ?>
                                                    <video controls>
                                                        <source src="{{ static_asset($r_post->img) }}" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                    <?php else: ?>
                                                    <div class="dz-image">
                                                        <img src="{{ static_asset($r_post->img) }}" alt="Uploaded Image">
                                                    </div>
                                                    <?php endif; ?>
                                                    <div class="">
                                                        <a href="javascript:void(0)" class="dz-remove-btn" data-dz-remove>Remove</a>
                                                    </div>
                                                </div>
                                                
                                                <div class="dz-message">
                                                    <!-- Message to display if no files are present -->
                                                    <div class="col-12">
                                                        <div class="message">Drop files here or click to upload.</div>
                                                    </div>
                                                    <input type="hidden" class="" id="file" name="file"
                                                value="{{ old('file', $r_post->img) }}">
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <div class="tab-pane fade" id="link" role="tabpanel"
                                            aria-labelledby="link-tab">
                                            <!-- Content for Link tab -->
                                            <div class="form-group">
                                                <label for="url">URL</label>
                                                <input type="text"
                                                    class="form-control @error('url') is-invalid @enderror" id="url"
                                                    name="url" placeholder="Enter URL"
                                                    value="{{ old('url', $r_post->url) }}">
                                                @error('url')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-primary">Update Post</button>
                                    </div>
                                </form>


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
         // Add event handling for remove button
         $(document).ready(function () {
        $(".dz-remove-btn").on("click", function () {
            alert('hi');
            $(".dz-preview").html('');
            
        });
    });

        Dropzone.options.dropzoneContainer = {
            url: "{{ route('file.upload') }}", // URL where files should be uploaded
            paramName: "file", // Name of the file parameter
            maxFilesize: 2, // Maximum file size in MB
            maxFiles: 1, // Maximum number of files allowed
            acceptedFiles: "image/*,video/*", // Accepted file types
            dictDefaultMessage: "Drop files here or click to upload", // Default message
            addRemoveLinks: true, // Show remove links for uploaded files
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Pass CSRF token
            },
            success: function(file, response) {
                // Handle the success response
                console.log(response.file_path);
                $("#file").val(response.file_path);
            },
            error: function(file, errorMessage) {
                // Handle the error message
                console.error(errorMessage);
                // Display error message to the user
                $("#dropzone-container").append('<div class="text-danger">' + errorMessage + '</div>');
            }
        };
    </script>
@endsection
