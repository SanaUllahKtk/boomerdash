@extends('frontend.layouts.app')
@section('meta_title'){{ 'Store' }}@stop
@section('meta_description'){{ 'Store Detail' }}@stop

    <style>
        .hedding {
            color: #ab8181`;
        }

        .main-section {
            position: absolute;
            left: 50%;
            right: 50%;
            transform: translate(-50%, 5%);
        }

        .left-side-product-box img {
            width: 100%;
        }

        .pro-box-section .pro-box img {
            width: 100%;
            height: 200px;
        }

        @media (min-width:360px) and (max-width:640px) {
            .pro-box-section .pro-box img {
                height: auto;
            }
        }
    </style>

@section('content')


    <div class="card">
        <div class="col-12 p-3 ">
            <div class="row hedding m-0 pl-3 pt-0 pb-3">
                <h2>Store Detail</h2>
            </div>
            <div class="row m-0">
                <div class="col-lg-4 left-side-product-box pb-3">
                    <img src="{{ uploaded_asset($store->logo) }}" class="border p-3" style="min-width: 100%;">
                </div>


                <div class="col-lg-8">
                    <div class="right-side-pro-detail border p-3 m-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4><strong>{{ $store->name }}</strong></h4>
                                <strong class="text-success mt-1">Cashback: {{ number_format($store->cashback, 2) }}
                                    %</strong> <br>
                                <a href="{{ $store->url }}" class="btn btn-primary mt-1">Earn Cash Back</a>


                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary redeem-cash" data-toggle="modal"
                                    data-target="#exampleModalLong"
                                    data-store-id="{{ $store->id }}">
                                    Redeem Cash Back
                                </button>

                                <p class="mt-2"><strong>Description: </strong></p>
                                <p class="">{!! $store->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Redeem Cash Back</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('cashback-redeem-request') }}" method="post" class="">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Order Total</label>
                            <input type="text" class="form form-control" name="total" value="" required>
                        </div>

                        <div class="form-group">
                            <label for="">Order Date</label>
                            <input type="date" class="form form-control" name="order_date" value="" required>
                            <input type="hidden" value="{{ $store->id }}" name="store_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary submit">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection