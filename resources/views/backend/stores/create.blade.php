@extends('backend.layouts.app')

@section('content')

@php
    CoreComponentRepository::instantiateShopRepository();
    CoreComponentRepository::initializeCache();
@endphp


<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Add New Store')}}</h5>
</div>


<div class="">
    <form class="form form-horizontal mar-top" action="{{route('stores.store')}}" method="POST" enctype="multipart/form-data" id="choice_form">
        @csrf

        <div class="card">

            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Store Information')}}</h5>
            </div>

            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-3 col-from-label">{{translate('Store Name')}} <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="name" placeholder="{{ translate('Store Name') }}" required>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-3 col-from-label">{{translate('Cashback')}} <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="cashback" placeholder="{{ translate('Cashback') }}" required>
                    </div>
                </div>
            </div>


            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-3 col-from-label">{{translate('Url')}} <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="url" placeholder="{{ translate('Url') }}" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Store Images')}}</h5>
            </div>

            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Gallery Images')}} <small>(600x600)</small></label>
                    <div class="col-md-8">
                        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="photos" class="selected-files">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                        <small class="text-muted">{{translate('These images are visible in product details page gallery. Use 600x600 sizes images.')}}</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Store Description')}}</h5>
            </div>

            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-3 col-from-label">{{translate('Description')}}</label>
                    <div class="col-md-8">
                        <textarea class="aiz-text-editor" name="description"></textarea>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-12">
            <div class="btn-toolbar float-right mb-3" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group mr-2" role="group" aria-label="Third group">
                    <button type="submit" name="button" value="Create" class="btn btn-primary action-btn">{{ translate('Save & Unpublish') }}</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('script')
<script type="text/javascript">
 $('form').bind('submit', function (e) {
		if ( $(".action-btn").attr('attempted') == 'true' ) {
			//stop submitting the form because we have already clicked submit.
			e.preventDefault();
		}
		else {
			$(".action-btn").attr("attempted", 'true');
		}
    });
</script>
@endsection