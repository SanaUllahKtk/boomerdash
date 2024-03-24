@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <h5 class="mb-0 h6">{{ translate('Add New ad') }}</h5>
    </div>

    <div class="">
        <form class="form form-horizontal mar-top" action="{{ route('ads.store') }}" method="POST"
            enctype="multipart/form-data" id="post_form">
            @csrf

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Ad Information') }}</h5>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('Title') }} <span
                                class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="title" placeholder="{{ translate('Title') }}"
                                required>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('Status') }} <span
                                class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <select name="status" id="" required class="form form-control">
                                <option value="">Select Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('Expire at') }} <span
                                class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <input type="datetime-local" class="form-control" name="expire" placeholder="{{ translate('Expire at') }}" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Ad Image') }}</h5>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="signinSrEmail">{{ translate('Ad Image') }}
                            </label>
                        <div class="col-md-8">
                            <div class="input-group" data-toggle="aizuploader" data-type="image" >
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">
                                        {{ translate('Browse') }}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="photos" class="selected-files">
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
                    <h5 class="mb-0 h6">{{ translate('Ad Video') }}</h5>
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
                        <button type="submit" class="btn btn-primary">{{ translate('Create') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
