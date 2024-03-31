@extends('frontend.layouts.app')

@section('content')
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
                                <h3>Create Post</h3>
                                
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
                                <form method="POST" action="{{ route('r_mobile_posts.store') }}" id="post-form">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="post-brand">Brands</label>
                                            <select name="brandId" id="brandId"
                                                class="form form-control @error('brandId') is-invalid @enderror">
                                                <option value="">Select Brand</option>
                                                @foreach ($brands as $key => $brand)
                                                    <option value="{{ $key }}"
                                                        @if (old('brandId') == $key) selected @endif>
                                                        {{ $brand }}</option>
                                                @endforeach
                                            </select>
                                            @error('brandId')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>



                                        <div class="col-md-6">
                                            <label for="post-product">Products</label>
                                            <select name="productId" id="productId"
                                                class="form form-control @error('productId') is-invalid @enderror">
                                                <option value="">Select Product</option>
                                            </select>
                                            @error('productId')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>




                                        <div class="col-md-12 mt-2">
                                            <!-- Content for Post tab -->
                                            <div class="form-group">
                                                <label for="post-title">Title</label>
                                                <input type="text"
                                                    class="form-control @error('post_title') is-invalid @enderror"
                                                    id="post-title" name="post_title" placeholder="Enter title"
                                                    value="{{ old('post_title') }}">
                                                @error('post_title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 d-none">
                                            <label for="post-category">Category</label>
                                            <select name="categoryId" id="category"
                                                class="form form-control @error('categoryId') is-invalid @enderror">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $key => $category)
                                                    <option value="{{ $key }}"
                                                        @if (old('categoryId') == $key) selected @endif>
                                                        {{ $category }}</option>
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
                                                    name="post_description" rows="3" placeholder="Enter description">{{ old('post_description') }}</textarea>
                                                @error('post_description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="media" role="tabpanel"
                                            aria-labelledby="media-tab">
                                            <!-- Content for Image and Video tab -->
                                            <div id="dropzone-container" class="dropzone">
                                                <div class="dz-message">
                                                    <div class="col-12">
                                                        <div class="message">Drop files here or click to upload.</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" class="" id="file" name="file"
                                                value="{{ old('file') }}">
                                            @error('file')
                                                <span class="invalid-feedback d-block" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="tab-pane fade" id="link" role="tabpanel"
                                            aria-labelledby="link-tab">
                                            <!-- Content for Link tab -->
                                            <div class="form-group">
                                                <label for="url">URL</label>
                                                <input type="text"
                                                    class="form-control @error('url') is-invalid @enderror" id="url"
                                                    name="url" placeholder="Enter URL" value="{{ old('url') }}">
                                                @error('url')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-primary">Post</button>
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
                console.log(response.filePath);
                $("#file").val(response.filePath);
            },
            error: function(file, errorMessage) {
                // Handle the error message
                console.error(errorMessage);
            }
        };


        $("#brandId").on("change", function(){
            var brandId = $(this).val();
            $.ajax({
                method: 'GET',
                url: '/getMobileProducts?brand_id=' + brandId,
                success: function(data) {
                    data = JSON.parse(data);
                    console.log(data);
                    $("#productId").html(data.html);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

        })
    </script>
@endsection
