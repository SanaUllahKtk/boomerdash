@extends('backend.layouts.app')

@section('content')
    @php
        CoreComponentRepository::instantiateShopRepository();
        CoreComponentRepository::initializeCache();
    @endphp


    <div class="aiz-titlebar text-left mt-2 mb-3">
        <h5 class="mb-0 h6">{{ translate('Add New Store Category') }}</h5>
    </div>


    <div class="">
        <form class="form form-horizontal mar-top" action="{{ route('store-categories.store') }}" method="POST"
            enctype="multipart/form-data" id="choice_form">
            @csrf

            <div class="card">

                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Store Category Information') }}</h5>
                </div>

                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-3 col-from-label">{{ translate('Name') }} <span
                                class="text-danger">*</span></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                placeholder="{{ translate('Name') }}" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="btn-toolbar float-right mb-3" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2" role="group" aria-label="Third group">
                        <button type="submit" name="button" value="Create"
                            class="btn btn-primary action-btn">{{ translate('Create') }}</button>
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
    </script>
@endsection
