@extends('frontend.layouts.app')
@section('meta_title'){{ 'Stores' }}@stop
@section('meta_description'){{ 'All Stores' }}@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <h2>{{ translate('Popular Stores') }}</h2>

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

                        @forelse ($stores as $store)
                            <div class="col-2 text-center">
                                <a href="{{ route('stores.show', $store->id) }}" class="">
                                    <div class="card p-1" style="position: relative;">
                                        <div class="fav-icon">
                                            <i class="la la-gratipay la-2x opacity-80 text-gray"></i>
                                        </div>
                                        <div class="text-center">
                                            <img src="{{ uploaded_asset($store->logo) }}" alt="" class="card-image">
                                        </div>
                                        <b class="text-dark">{{ $store->name }}</b>
                                        <p class="text-success" style="font-size: 12px;"><strong>Cashback:
                                                {{ number_format($store->cashback, 2) }} %</strong>
                                        </p>
                                    </div>
                                </a>
                            </div>
                        @empty
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

                        @forelse ($stores as $store)
                            <div class="col-2 text-center">
                                <a href="{{ route('stores.show', $store->id) }}" class="">
                                    <div class="card p-1" style="position: relative;">
                                        <div class="fav-icon">
                                            <i class="la la-gratipay la-2x opacity-80 text-gray"></i>
                                        </div>
                                        <div class="text-center">
                                            <img src="{{ uploaded_asset($store->logo) }}" alt="" class="card-image">
                                        </div>
                                        <b class="text-dark">{{ $store->name }}</b>
                                        <p class="text-success" style="font-size: 12px;"><strong>Cashback:
                                                {{ number_format($store->cashback, 2) }} %</strong>
                                        </p>
                                    </div>
                                </a>
                            </div>
                        @empty
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('script')
    <script>
        $(document).ready(function() {
            $('.fav-icon').click(function() {
                var icon = $(this).find('i');
                if (icon.css('color') !== 'rgb(255, 0, 0)') {
                    // If the icon is not red, change its color to red
                    icon.css('color', 'red');
                } else {
                    // If the icon is red, remove the red color
                    icon.css('color', '');
                }
            });
        });
    </script>
@endsection
