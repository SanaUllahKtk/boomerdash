<div class="aiz-card-box border border-gray rounded hov-shadow-md mt-1 mb-2 has-transition">
    @if(discount_in_percentage($product) > 0)
        <span class="badge-custom">{{ translate('OFF') }}<span class="box ml-1 mr-0">&nbsp;{{discount_in_percentage($product)}}%</span></span>
    @endif
    <div class="position-relative">
        @php
            $product_url = route('product', $product->slug);
            if($product->auction_product == 1) {
                $product_url = route('auction-product', $product->slug);
            }
        @endphp
        <a href="{{ $product_url }}" class="d-block" style="pointer-events: cursor;">
        
            <img
                class="img-fit lazyload mx-auto h-140px h-md-210px"
                src="{{ static_asset('assets/img/placeholder.jpg') }}"
                data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                alt="{{  $product->getTranslation('name')  }}"
                onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
            >
        </a>
        @if ($product->wholesale_product)
            <span class="absolute-bottom-left fs-11 text-white fw-600 px-2 lh-1-8" style="background-color: #455a64">
                {{ translate('Wholesale') }}
            </span>
        @endif
       
    </div>
    <div class="p-md-3 p-2 text-left">
       
        <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px product_name">
            <a href="{{ $product_url }}" class="d-block text-reset" style="pointer-events: none;">{{  $product->getTranslation('name')  }}</a>
        </h3>
        <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0 h-35px product_desc">
        Earn up to <span style="text-transform:lowercase"> {{ home_discounted_base_price($product) }}</span>
        </h3>
        <div class="d-flex align-items-center justify-content-between">
    
        <a href="javascript:void(0)" class="btn btn-primary" onclick="addToCart({{ $product->id }})" style="text-decoration: none; font-weight:bold">Add to Cart</a>
        </div>
        @if (addon_is_activated('club_point'))
            <!-- <div class="rounded px-2 mt-2 bg-soft-primary border-soft-primary border">
                {{ translate('Club Point') }}:
                <span class="fw-700 float-right">{{ $product->earn_point }}</span>
            </div> -->
        @endif
    </div>
</div>
