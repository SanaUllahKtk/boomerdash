@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <h5 class="mb-0 h6">{{ translate('Add New Post Category') }}</h5>
    </div>

    <form class="form form-horizontal" action="{{ route('r_categories.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{ translate('Post Category Information') }}</h5>
            </div>

            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-3 col-from-label">{{ translate('Name') }} <span class="text-danger">*</span></label>
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

        <div class="text-right mt-3">
            <button type="submit" class="btn btn-primary">{{ translate('Create') }}</button>
        </div>
    </form>
@endsection
