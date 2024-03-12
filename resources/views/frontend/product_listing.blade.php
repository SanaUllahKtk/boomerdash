@extends('frontend.layouts.app')

@if (isset($category_id))
    @php
        $meta_title = \App\Models\Category::find($category_id)->meta_title;
        $meta_description = \App\Models\Category::find($category_id)->meta_description;
    @endphp
@elseif (isset($brand_id))
    @php
        $meta_title = \App\Models\Brand::find($brand_id)->meta_title;
        $meta_description = \App\Models\Brand::find($brand_id)->meta_description;
    @endphp
@else
    @php
        $meta_title         = get_setting('meta_title');
        $meta_description   = get_setting('meta_description');
    @endphp
@endif

@section('meta_title'){{ $meta_title }}@stop
@section('meta_description'){{ $meta_description }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $meta_title }}">
    <meta itemprop="description" content="{{ $meta_description }}">

    <!-- Twitter Card data -->
    <meta name="twitter:title" content="{{ $meta_title }}">
    <meta name="twitter:description" content="{{ $meta_description }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $meta_title }}" />
    <meta property="og:description" content="{{ $meta_description }}" />
@endsection

@section('content')

    <section class="mb-4 pt-5">
        <div class="container-fluid sm-px-0">
            <form class="" id="search-form" action="" method="GET">
                <div class="row">
                   
                    <div class="col-xl-7">

                        
                        <input type="hidden" name="min_price" value="">
                        <input type="hidden" name="max_price" value="">
                        <div class="row gutters-5 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-3 row-cols-md-3 row-cols-2">
                            @foreach ($products as $key => $product)
                                <div class="col">
                                    @include('frontend.partials.product_box_1',['product' => $product])
                                </div>
                            @endforeach
                        </div>
                        <div class="aiz-pagination aiz-pagination-center mt-4">
                            {{ $products->appends(request()->input())->links() }}
                        </div>
                    </div>
                    <div class="col-xl-5">
                        <div id="cart-summary">
                            @if ($carts && count($carts) > 0)
                                <div class="row">
                                    <div class="col-xxl-12 col-xl-12 mx-auto">
                                        <div class="shadow-sm bg-white p-3 p-lg-4 rounded text-left">
                                            <div class="mb-4">
                                                <div class="row gutters-5 d-none d-lg-flex border-bottom mb-3 pb-3">
                                                    <div class="col-md-5 fw-600">{{ translate('Product') }}</div>
                                                    <div class="col fw-600">{{ translate('Price') }}</div>
                                                    <!-- <div class="col fw-600">{{ translate('Tax') }}</div> -->
                                                    <div class="col fw-600">{{ translate('Quantity') }}</div>
                                                    <!-- <div class="col fw-600">{{ translate('Total') }}</div> -->
                                                    <div class="col-auto fw-600">{{ translate('Remove') }}</div>
                                                </div>
                                                <ul class="list-group list-group-flush">
                                                    @php
                                                        $total = 0;
                                                    @endphp
                                                    @foreach ($carts as $key => $cartItem)
                                                        @php
                                                            $product = \App\Models\Product::find($cartItem['product_id']);
                                                            $product_stock = $product->stocks->where('variant', $cartItem['variation'])->first();
                                                            // $total = $total + ($cartItem['price'] + $cartItem['tax']) * $cartItem['quantity'];
                                                            $total = $total + cart_product_price($cartItem, $product, false) * $cartItem['quantity'];
                                                            $product_name_with_choice = $product->getTranslation('name');
                                                            if ($cartItem['variation'] != null) {
                                                                $product_name_with_choice = $product->getTranslation('name') . ' - ' . $cartItem['variation'];
                                                            }
                                                        @endphp
                                                        <li class="list-group-item px-0 px-lg-3">
                                                            <div class="row gutters-5">
                                                                <div class="col-lg-5 d-flex">
                                                                    <span class="mr-2 ml-0">
                                                                        <img src="{{ uploaded_asset($product->thumbnail_img) }}"
                                                                            class="img-fit size-60px rounded"
                                                                            alt="{{ $product->getTranslation('name') }}">
                                                                    </span>
                                                                    <span class="fs-14 opacity-60">{{ $product_name_with_choice }}</span>
                                                                </div>

                                                                <div class="col-lg col-4 order-1 order-lg-0 my-3 my-lg-0">
                                                                    <span
                                                                        class="opacity-60 fs-12 d-block d-lg-none">{{ translate('Price') }}</span>
                                                                    <span
                                                                        class="fw-600 fs-16">{{ cart_product_price($cartItem, $product, true, false) }}</span>
                                                                </div>
                                                                <!-- <div class="col-lg col-4 order-2 order-lg-0 my-3 my-lg-0">
                                                                    <span
                                                                        class="opacity-60 fs-12 d-block d-lg-none">{{ translate('Tax') }}</span>
                                                                    <span
                                                                        class="fw-600 fs-16">{{ cart_product_tax($cartItem, $product) }}</span>
                                                                </div> -->

                                                                <div class="col-lg col-6 order-4 order-lg-0">
                                                                    @if ($cartItem['digital'] != 1 && $product->auction_product == 0)
                                                                        <div
                                                                            class="row no-gutters align-items-center aiz-plus-minus mr-2 ml-0">
                                                                            <button
                                                                                class="btn col-auto btn-icon btn-sm btn-circle btn-light"
                                                                                type="button" data-type="minus"
                                                                                data-field="quantity[{{ $cartItem['id'] }}]">
                                                                                <i class="las la-minus"></i>
                                                                            </button>
                                                                            <input type="number" name="quantity[{{ $cartItem['id'] }}]"
                                                                                class="col border-0 text-center flex-grow-1 fs-16 input-number"
                                                                                placeholder="1" value="{{ $cartItem['quantity'] }}"
                                                                                min="{{ $product->min_qty }}"
                                                                                max="{{ $product_stock->qty }}"
                                                                                onchange="updateQuantity({{ $cartItem['id'] }}, this)">
                                                                            <button
                                                                                class="btn col-auto btn-icon btn-sm btn-circle btn-light"
                                                                                type="button" data-type="plus"
                                                                                data-field="quantity[{{ $cartItem['id'] }}]">
                                                                                <i class="las la-plus"></i>
                                                                            </button>
                                                                        </div>
                                                                    @elseif($product->auction_product == 1)
                                                                        <span class="fw-600 fs-16">1</span>
                                                                    @endif
                                                                </div>
                                                                <!-- <div class="col-lg col-4 order-3 order-lg-0 my-3 my-lg-0">
                                                                    <span
                                                                        class="opacity-60 fs-12 d-block d-lg-none">{{ translate('Total') }}</span>
                                                                    <span
                                                                        class="fw-600 fs-16 text-primary">{{ single_price(cart_product_price($cartItem, $product, false) * $cartItem['quantity']) }}</span>
                                                                </div> -->
                                                                <div class="col-lg-auto col-6 order-5 order-lg-0 text-right">
                                                                    <a href="javascript:void(0)"
                                                                        onclick="removeFromCartView(event, {{ $cartItem['id'] }})"
                                                                        class="btn btn-icon btn-sm btn-soft-primary btn-circle">
                                                                        <i class="las la-trash"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>

                                            <div class="px-3 py-2 mb-4 border-top d-flex justify-content-between">
                                                <span class="opacity-60 fs-15">{{ translate('Subtotal') }}</span>
                                                <span class="fw-600 fs-17">{{ single_price($total) }}</span>
                                            </div>
                                            <div class="row align-items-center">
                                                <div class="col-md-6 text-center text-md-left order-1 order-md-0">
                                                    <a href="{{ route('search') }}" class="btn btn-link">
                                                        <i class="las la-arrow-left"></i>
                                                        {{ translate('Return to shop') }}
                                                    </a>
                                                </div>
                                                <div class="col-md-6 text-center text-md-right">
                                                    @if (Auth::check())
                                                        <a href="{{ route('checkout.shipping_info') }}" class="btn btn-primary fw-600">
                                                            {{ translate('Continue to Shipping') }}
                                                        </a>
                                                    @else
                                                        <button class="btn btn-primary fw-600"
                                                            onclick="showCheckoutModal()">{{ translate('Continue to Shipping') }}</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-xl-12 mx-auto">
                                        <div class="shadow-sm bg-white p-4 rounded">
                                            <div class="text-center p-3">
                                                <i class="las la-frown la-3x opacity-60 mb-3"></i>
                                                <h3 class="h4 fw-700">{{ translate('Your Cart is empty') }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
            function addToCart(id){
            // if(checkAddToCartValidity()) {
                // $('#addToCart').modal();
                // $('.c-preloader').show();
                $.ajax({
                    type:"POST",
                    url: '{{ route('cart.addToCart') }}',
                    data: {
                    id:id,
                    quantity: 1,
                    _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function(datas){
                        console.log(datas);
                    //    $('#addToCart-modal-body').html(null);
                    //    $('.c-preloader').hide();
                    //    $('#modal-size').removeClass('modal-lg');
                    //    $('#addToCart-modal-body').html(data.modal_view);
                       AIZ.extra.plusMinus();
                       AIZ.plugins.slickCarousel();
                       updateNavCart(datas.nav_cart_view,datas.cart_count);
                       $('#cart-summary').html(datas.cart_view);
                       AIZ.plugins.notify('success', "{{ translate('Product added to cart') }}");
                    }
                });
            // }
            // else{
            //     AIZ.plugins.notify('warning', "{{ translate('Please choose all the options') }}");
            // }
        }

        function filter(){
            $('#search-form').submit();
        }
        function rangefilter(arg){
            $('input[name=min_price]').val(arg[0]);
            $('input[name=max_price]').val(arg[1]);
            filter();
        }
    </script>
    <script type="text/javascript">
        function removeFromCartView(e, key) {
            e.preventDefault();
            removeFromCart(key);
        }

        function updateQuantity(key, element) {
            $.post('{{ route('cart.updateQuantity') }}', {
                _token: AIZ.data.csrf,
                id: key,
                quantity: element.value
            }, function(data) {
                updateNavCart(data.nav_cart_view, data.cart_count);
                $('#cart-summary').html(data.cart_view);
            });
        }

        function showCheckoutModal() {
            $('#login-modal').modal();
        }

        // Country Code
        var isPhoneShown = true,
            countryData = window.intlTelInputGlobals.getCountryData(),
            input = document.querySelector("#phone-code");

        for (var i = 0; i < countryData.length; i++) {
            var country = countryData[i];
            if (country.iso2 == 'bd') {
                country.dialCode = '88';
            }
        }

        var iti = intlTelInput(input, {
            separateDialCode: true,
            utilsScript: "{{ static_asset('assets/js/intlTelutils.js') }}?1590403638580",
            onlyCountries: @php echo json_encode(\App\Models\Country::where('status', 1)); @endphp,
            customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                if (selectedCountryData.iso2 == 'bd') {
                    return "01xxxxxxxxx";
                }
                return selectedCountryPlaceholder;
            }
        });

        var country = iti.getSelectedCountryData();
        $('input[name=country_code]').val(country.dialCode);

        input.addEventListener("countrychange", function(e) {
            // var currentMask = e.currentTarget.placeholder;

            var country = iti.getSelectedCountryData();
            $('input[name=country_code]').val(country.dialCode);

        });

        function toggleEmailPhone(el) {
            if (isPhoneShown) {
                $('.phone-form-group').addClass('d-none');
                $('.email-form-group').removeClass('d-none');
                $('input[name=phone]').val(null);
                isPhoneShown = false;
                $(el).html('{{ translate('Use Phone Instead') }}');
            } else {
                $('.phone-form-group').removeClass('d-none');
                $('.email-form-group').addClass('d-none');
                $('input[name=email]').val(null);
                isPhoneShown = true;
                $(el).html('{{ translate('Use Email Instead') }}');
            }
        }
    </script>
@endsection