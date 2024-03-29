@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <h5 class="mb-0 h6">{{ translate('Edit Post Category') }}</h5>
    </div>

    <form class="form form-horizontal" action="{{ route('r_categories.update', ['r_category' => $r_category->id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{ translate('Post Category Information') }}</h5>
            </div>

            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">{{ translate('Name') }} <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            placeholder="{{ translate('Name') }}" value="{{ old('name', $r_category->name) }}" required>
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
            <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
        </div>
    </form>
@endsection
