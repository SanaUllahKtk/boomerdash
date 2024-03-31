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
                                <form method="POST" action="{{ route('r_posts.store') }}" id="post-form">
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



                                    </div>

                                    <div class="tab-content mt-3" id="myTabContent">
                                        <div class="tab-pane fade show active" id="post" role="tabpanel"
                                            aria-labelledby="post-tab">
                                            <!-- Content for Post tab -->
                                            <div class="form-group">
                                                <label for="post-title">Title</label>
                                                <input type="text"
                                                    class="form-control @error('post_title') is-invalid @enderror"
                                                    id="post-title" placeholder="Enter title" value="" readonly>
                                                <input type="hidden" name="post_title" value="">
                                            </div>

                                            <div class="form-group">
                                                <label for="post-description">Description</label>
                                                <textarea class="aiz-text-editor form-control @error('post_description') is-invalid @enderror" id="post-description"
                                                    readonly row="3" placeholder="Enter description">
                                                </textarea>
                                                <input type="hidden" name="post_description" value="">
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="media" role="tabpanel"
                                            aria-labelledby="media-tab">

                                            <div class="form-group">
                                                <div class="input-group" data-toggle="aizuploader" data-type="image"
                                                    data-multiple="true">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                                            {{ translate('Browse') }}</div>
                                                    </div>
                                                    <div class="form-control file-amount">{{ translate('Choose File') }}
                                                    </div>
                                                    <input type="hidden" name="photos" value=""
                                                        class="selected-files">
                                                </div>
                                                <div class="file-preview box sm">
                                                </div>
                                                <small
                                                    class="text-muted">{{ translate('These images are visible in product details page gallery. Use 600x600 sizes images.') }}</small>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="link" role="tabpanel"
                                            aria-labelledby="link-tab">
                                            <!-- Content for Link tab -->
                                            <div class="form-group">
                                                <label for="url">URL</label>
                                                <input type="text"
                                                    class="form-control @error('url') is-invalid @enderror" id="url"
                                                    readonly placeholder="Enter URL" value="">
                                                <input type="hidden" name="url" value="">
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


        $("#brandId").on("change", function() {
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

        $("#productId").on("change", function() {
            var productId = $(this).val();
            $.ajax({
                method: 'GET',
                url: '/getProductDetail?product_id=' + productId,
                success: function(data) {
                    data = JSON.parse(data);
                    console.log(data);
                    $("#myTabContent").html(data.html);
                    textEditor();
                    preview();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

        })

        function textEditor(){
            $(".aiz-text-editor").each(function (el) {
                var $this = $(this);
                var buttons = $this.data("buttons");
                var minHeight = $this.data("min-height");
                var placeholder = $this.attr("placeholder");
                var format = $this.data("format");

                buttons = !buttons
                    ? [
                          ["font", ["bold", "underline", "italic", "clear"]],
                          ["para", ["ul", "ol", "paragraph"]],
                          ["style", ["style"]],
                          ["color", ["color"]],
                          ["table", ["table"]],
                          ["insert", ["link", "picture", "video"]],
                          ["view", ["fullscreen", "undo", "redo"]],
                      ]
                    : buttons;
                placeholder = !placeholder ? "" : placeholder;
                minHeight = !minHeight ? 200 : minHeight;
                format = (typeof format == 'undefined') ? false : format;

                $this.summernote({
                    toolbar: buttons,
                    placeholder: placeholder,
                    height: minHeight,
                    callbacks: {
                        onImageUpload: function (data) {
                            data.pop();
                        },
                        onPaste: function (e) {
                            if(format){
                                var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                                e.preventDefault();
                                document.execCommand('insertText', false, bufferText);
                            }
                        }
                    }
                });

                var nativeHtmlBuilderFunc = $this.summernote('module', 'videoDialog').createVideoNode;

                $this.summernote('module', 'videoDialog').createVideoNode =  function(url) 
                {   
                    var wrap = $('<div class="embed-responsive embed-responsive-16by9"></div>');
                    var html = nativeHtmlBuilderFunc(url);
                        html = $(html).addClass('embed-responsive-item');
                    return wrap.append(html)[0];
                };
            });
        }

        function preview(){
            $('[data-toggle="aizuploader"]').each(function () {
                var $this = $(this);
                var files = $this.find(".selected-files").val();
                if(files != ""){
                    $.post(
                        AIZ.data.appUrl + "/aiz-uploader/get_file_by_ids",
                        { _token: AIZ.data.csrf, ids: files },
                        function (data) {
                            $this.next(".file-preview").html(null);

                            if (data.length > 0) {
                                $this.find(".file-amount").html(
                                    AIZ.uploader.updateFileHtml(data)
                                );
                                for (
                                    var i = 0;
                                    i < data.length;
                                    i++
                                ) {
                                    var thumb = "";
                                    if (data[i].type === "image") {
                                        thumb =
                                            '<img src="' +
                                            data[i].file_name +
                                            '" class="img-fit">';
                                    } else {
                                        thumb = '<i class="la la-file-text"></i>';
                                    }
                                    var html =
                                        '<div class="d-flex justify-content-between align-items-center mt-2 file-preview-item" data-id="' +
                                        data[i].id +
                                        '" title="' +
                                        data[i].file_original_name +
                                        "." +
                                        data[i].extension +
                                        '">' +
                                        '<div class="align-items-center align-self-stretch d-flex justify-content-center thumb">' +
                                        thumb +
                                        "</div>" +
                                        '<div class="col body">' +
                                        '<h6 class="d-flex">' +
                                        '<span class="text-truncate title">' +
                                        data[i].file_original_name +
                                        "</span>" +
                                        '<span class="ext flex-shrink-0">.' +
                                        data[i].extension +
                                        "</span>" +
                                        "</h6>" +
                                        "<p>" +
                                        AIZ.extra.bytesToSize(
                                            data[i].file_size
                                        ) +
                                        "</p>" +
                                        "</div>" +
                                        '<div class="remove">' +
                                        '<button class="btn btn-sm btn-link remove-attachment" type="button">' +
                                        '<i class="la la-close"></i>' +
                                        "</button>" +
                                        "</div>" +
                                        "</div>";

                                    $this.next(".file-preview").append(html);
                                }
                            } else {
                                $this.find(".file-amount").html(AIZ.local.choose_file);
                            }
                    });
                }
            });
        }
    </script>
@endsection
