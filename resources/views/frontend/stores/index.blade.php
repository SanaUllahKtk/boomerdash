@extends('frontend.layouts.app')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="d-flex align-items-start">
                @include('frontend.inc.user_side_nav')

                <div class="aiz-user-panel">
                    <div class="aiz-titlebar mt-2 mb-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h1 class="h3">{{ translate('All Stores') }}</h1>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h2 style="display: inline-block; vertical-align: middle;">{{ translate('Popular Stores') }}
                                </h2>

                                <form action="{{ route('stores.seller.all') }}" id="category-form">
                                    <select name="category_id" id="change-category" class="form-control select2 float-end">
                                        <option value="">Select Category</option>
                                        @forelse($categories as $key => $category)
                                            <option value="{{ $key }}"> {{ $category }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </form>
                            </div>



                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <style>
                                        .fav-icon {
                                            position: absolute;
                                            top: 5px;
                                            right: 5px;
                                        }

                                        .card-image {
                                            width: 50px;
                                            height: 50px;
                                        }
                                    </style>

                                    <div class="row">

                                        @forelse ($popular_stores as $store)
                                            <div class="col-md-4 text-center">
                                                <a href="{{ route('stores.show', $store->id) }}" class="">
                                                    <div class="card p-1" style="position: relative;">
                                                        <div class="fav-icon" data-store-id="{{ $store->id }}"
                                                            data-store-type="{{ $store->type }}">
                                                            <i class="la la-gratipay la-2x opacity-80 text-gray"
                                                                style="color: red;"></i>
                                                        </div>
                                                        <div class="text-center">
                                                            <img src="{{ uploaded_asset($store->logo) }}" alt=""
                                                                class="card-image">
                                                        </div>
                                                        <b class="text-dark">{{ $store->name }}</b>
                                                        <p class="text-success" style="font-size: 12px;"><strong>Cashback:
                                                                {{ number_format($store->cashback, 2) }} %</strong></p>
                                                    </div>
                                                </a>
                                            </div>
                                        @empty
                                            <div class="col-12">
                                                <p class="text-center">No Record Found!!!</p>
                                            </div>
                                        @endforelse

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-body">
                            <h2>{{ translate('New Stores') }}</h2>

                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <style>
                                        .fav-icon {
                                            position: absolute;
                                            top: 5px;
                                            right: 5px;
                                        }

                                        .card-image {
                                            width: 50px;
                                            height: 50px;
                                        }
                                    </style>

                                    <div class="row">

                                        @forelse ($new_stores as $store)
                                            <div class="col-md-4 text-center">
                                                <a href="{{ route('stores.show', $store->id) }}" class="">
                                                    <div class="card p-1" style="position: relative;">
                                                        <div class="fav-icon" data-store-id="{{ $store->id }}"
                                                            data-store-type="{{ $store->type }}">
                                                            <i class="la la-gratipay la-2x opacity-80 text-gray"
                                                                style="color: red;}}"></i>
                                                        </div>
                                                        <div class="text-center">
                                                            <img src="{{ uploaded_asset($store->logo) }}" alt=""
                                                                class="card-image">
                                                        </div>
                                                        <b class="text-dark">{{ $store->name }}</b>
                                                        <p class="text-success" style="font-size: 12px;"><strong>Cashback:
                                                                {{ number_format($store->cashback, 2) }} %</strong></p>
                                                    </div>
                                                </a>
                                            </div>
                                        @empty
                                            <div class="col-12">
                                                <p class="text-center">No Record Found!!!</p>
                                            </div>
                                        @endforelse


                                    </div>
                                </div>
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
        $(document).ready(function() {
            $('.fav-icon').click(function(e) {
                e.preventDefault();

                var icon = $(this).find('i');
                var is_fav = 'saved';
                var store_id = $(this).data('store-id');
                var type = $(this).data('store-type');

                if (icon.css('color') !== 'rgb(255, 0, 0)') {
                    // If the icon is not red, change its color to red
                    icon.css('color', 'red');
                    is_fav = 'saved';
                } else {
                    // If the icon is red, remove the red color
                    icon.css('color', '');
                    is_fav = 'delete';
                }

                $.ajax({
                    url: '{{ route('store-favorite') }}',
                    method: 'GET',
                    data: {
                        store_id: store_id,
                        is_fav: is_fav,
                        type: type
                    },
                    success: function(response) {
                        // Handle the success response here
                    },
                    error: function(xhr, status, error) {
                        // Handle errors here
                    }
                });

            });
        });

        $("#change-category").on("change", function() {
            $("#category-form").submit();
        });
    </script>
@endsection
