@extends('backend.layouts.app')

@section('content')


    <div class="aiz-titlebar text-left mt-2 mb-3">
        <h5 class="mb-0 h6">{{ translate('Edit New Product') }}</h5>
    </div>


    <div class="">
        <form class="form form-horizontal mar-top" action="{{ route('r_products.update', ['r_product' => $r_product]) }}" method="POST"
            enctype="multipart/form-data" id="choice_form">
            @csrf
            @method('PUT')

            <div class="card">

                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Product Information') }}</h5>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('Product Title') }} <span
                                class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="title"
                               value="{{ $r_product->title }}" placeholder="{{ translate('Product Title') }}" required>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('Brands') }} <span
                                class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <select name="brandId" id="" class="form form-control">
                                <option value="">Select Brand</option>
                                @forelse($brands as $key => $brand)
                                <option value="{{$key}}" {{ $r_product->brandId == $key ? 'selected' : ''}}>{{$brand}}</option>
                                @empty 

                                @endforelse
                            </select>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('Url') }} <span
                                class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="url" placeholder="{{ translate('Url') }}"
                            value="{{ $r_product->url }}" required>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('Points') }} <span
                                class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" name="points" placeholder="{{ translate('Points') }}"
                            value="{{ $r_product->points }}"  required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Product Images') }}</h5>
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
                                <input type="hidden" name="photos" value="{{ $r_product->img }}" class="selected-files">
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
                    <h5 class="mb-0 h6">{{ translate('Product Description') }}</h5>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('Description') }}</label>
                        <div class="col-md-8">
                            <textarea class="aiz-text-editor" name="description">{!! $r_product->description !!}</textarea>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12">
                <div class="btn-toolbar float-right mb-3" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2" role="group" aria-label="Third group">
                        <button type="submit" name="button" value="Update"
                            class="btn btn-primary action-btn">{{ translate('Update') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('form').bind('submit', function(e) {
            if ($(".action-btn").attr('attempted') == 'true') {
                //stop submitting the form because we have already clicked submit.
                e.preventDefault();
            } else {
                $(".action-btn").attr("attempted", 'true');
            }
        });

        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
