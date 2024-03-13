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
                <img src="{{ uploaded_asset($store->logo) }}" class="border p-3" style="min-height: 100%; min-width: 100%;">
            </div>
            
            
            <div class="col-lg-8">
                <div class="right-side-pro-detail border p-3 m-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4><strong>{{ $store->name }}</strong></h4>
                            <strong class="text-success mt-1">Cashback: {{ number_format($store->cashback, 2) }} %</strong> <br>
                            <a href="{{ $store->url }}" class="btn btn-primary mt-1">Earn Cash Button</a>

                            <p class="mt-2"><strong>Description: </strong></p>
                            <p class="">{!! $store->description !!}</p>
                        </div>                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 