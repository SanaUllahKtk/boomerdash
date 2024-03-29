@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <h5 class="mb-0 h6">{{ translate('Update Discover Story') }}</h5>
    </div>

    <div class="">
        <form class="form form-horizontal mar-top" action="{{ route('posts.update', $post->id) }}" method="POST"
            enctype="multipart/form-data" id="post_form">
            @csrf
            @method('PUT') 

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Discover Story Information') }}</h5>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('Title') }} <span
                                class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="title" placeholder="{{ translate('Title') }}"
                               value="{{ $post->title }}" required>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('Slug') }} <span
                                class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="slug" placeholder="{{ translate('Slug') }}"
                            value="{{ $post->slug }}"  required>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('Category') }} <span
                                class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <select name="category_id" id="" class="form form-control">
                                <option value="">Select Category</option>
                               @forelse ($categories as $key => $category)
                               <option value="{{ $key }}" {{ $post->category_id == $key ? 'selected' : ''}}>{{ $category }}</option>
                               @empty
                                   
                               @endforelse
                            </select>
                        </div>
                    </div>
                </div>



                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('Type') }} <span
                                class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <select name="type" id="" class="form form-control">
                                <option value="">Select type</option>
                                <option value="latest" {{ $post->type == 'latest' ? 'selected' : ''}}>Latest</option>
                            </select>
                        </div>
                    </div>
                </div>

                <style>
                    .note-modal .note-group-select-from-files{
                        display: block !important;
                    }
                </style>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('Description') }}</label>
                        <div class="col-md-8">
                            <textarea class="" id="summernote" name="description">{!! $post->content !!}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Time & Points') }}</h5>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('Time in Seconds') }} <span
                                class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" name="timer" placeholder="{{ translate('Seconds') }}"
                            value="{{ $post->timer }}" required>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('Points') }} <span
                                class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" name="points" placeholder="{{ translate('Points') }}"
                            value="{{ $post->points }}"  required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Images') }}</h5>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="signinSrEmail">{{ translate('Gallery Images') }}
                            <small>(600x600)</small></label>
                        <div class="col-md-8">
                            <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">
                                        {{ translate('Browse') }}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="photos" class="selected-files" value="{{ $post->photo }}">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                            <small
                                class="text-muted">{{ translate('These images are visible in product details page gallery. Use 600x600 sizes images.') }}</small>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Video') }}</h5>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Video')}}</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <input type="file" name="videolink" class="selected-files">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12">
                <div class="btn-toolbar float-right mb-3" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2" role="group" aria-label="Third group">
                        <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section("script")
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
     $('#summernote').summernote({
        //imageUploadUrl: '{{ route("upload.image") }}'
        height: ($(window).height() - 300),
            // callbacks: {
            //     onImageUpload: function(files) {
            //         uploadImage(files[0]);
            //     }
            // }
        
     });

     function uploadImage(image) {
            var data = new FormData();
            data.append("image", image);
            $.ajax({
                url: 'Your url to deal with your image',
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                type: "post",
                success: function(url) {
                    var image = $('<img>').attr('src', url);
                    $('#summernote').summernote("insertNode", image[0]);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }
</script>
@endsection 
