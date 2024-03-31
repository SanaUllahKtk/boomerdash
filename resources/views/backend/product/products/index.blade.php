@extends('backend.layouts.app')

@section('content')

    @php
        CoreComponentRepository::instantiateShopRepository();
        CoreComponentRepository::initializeCache();
    @endphp

    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="h3">{{ translate('All products') }}</h1>
            </div>
            @if ($type != 'Seller')
                <div class="col text-right">
                    <a href="{{ route('products.create') }}" class="btn btn-circle btn-info">
                        <span>{{ translate('Add New Product') }}</span>
                    </a>
                </div>
            @endif
        </div>
    </div>
    <br>

    <div class="card">
        <form class="" id="sort_products" action="" method="GET">
            <div class="card-header row gutters-5">
                <div class="col">
                    <h5 class="mb-md-0 h6">{{ translate('All Product') }}</h5>
                </div>

                <div class="dropdown mb-2 mb-md-0">
                    <button class="btn border dropdown-toggle" type="button" data-toggle="dropdown">
                        {{ translate('Bulk Action') }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#" onclick="bulk_delete()">
                            {{ translate('Delete selection') }}</a>
                    </div>
                </div>

                <div class="col-md-2 ml-auto">
                    <select class="form-control form-control-sm aiz-selectpicker mb-2 mb-md-0" name="type" id="type"
                        onchange="sort_products()">
                        <option value="">{{ translate('Sort By') }}</option>
                        @foreach([
                            'rating,desc' => 'Rating (High > Low)',
                            'rating,asc' => 'Rating (Low > High)',
                            'num_of_sale,desc' => 'Num of Sale (High > Low)',
                            'num_of_sale,asc' => 'Num of Sale (Low > High)',
                            'unit_price,desc' => 'Base Price (High > Low)',
                            'unit_price,asc' => 'Base Price (Low > High)',
                        ] as $value => $label)
                            <option value="{{ $value }}" @isset($col_name, $query) @if ($value == "$col_name,$query") selected @endif @endisset>
                                {{ translate($label) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="form-group mb-0">
                        <input type="text" class="form-control form-control-sm" id="search" name="search"
                            @isset($sort_search) value="{{ $sort_search }}" @endisset
                            placeholder="{{ translate('Type & Enter') }}">
                    </div>
                </div>
            </div>

            <div class="card-body">
                
                
                
                
                <table class="table aiz-table mb-0">
                    <thead>
                        <tr>
                            <th>
                                <div class="form-group">
                                    <div class="aiz-checkbox-inline">
                                        <label class="aiz-checkbox">
                                            <input type="checkbox" class="check-all">
                                            <span class="aiz-square-check"></span>
                                        </label>
                                    </div>
                                </div>
                            </th>
                            <th>{{ translate('Name') }}</th>
                            @if ($type == 'Seller' || $type == 'All')
                                <th data-breakpoints="lg">{{ translate('Added By') }}</th>
                            @endif
                            <th data-breakpoints="sm">{{ translate('Info') }}</th>
                            <th data-breakpoints="lg">{{ translate('Todays Deal') }}</th>
                            <th data-breakpoints="lg">{{ translate('Published') }}</th>
                            @if (get_setting('product_approve_by_admin') == 1 && $type == 'Seller')
                                <th data-breakpoints="lg">{{ translate('Approved') }}</th>
                            @endif
                            <th data-breakpoints="lg">{{ translate('Featured') }}</th>
                            <th data-breakpoints="sm" class="text-right">{{ translate('Options') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $key => $product)
                            <tr>
                                <td>
                                    <div class="form-group d-inline-block">
                                        <label class="aiz-checkbox">
                                            <input type="checkbox" class="check-one" name="id[]"
                                                value="{{ $product->id }}">
                                            <span class="aiz-square-check"></span>
                                        </label>
                                    </div>
                                </td>
                                <td>
                                    <div class="row gutters-5 w-200px w-md-300px mw-100">
                                        <div class="col-auto">
                                            <img src="{{ uploaded_asset($product->thumbnail_img) }}" alt="Image"
                                                class="size-50px img-fit">
                                        </div>
                                        <div class="col">
                                            <span class="text-muted text-truncate-2">{{ $product->getTranslation('name') }}</span>
                                        </div>
                                    </div>
                                </td>
                                @if ($type == 'Seller' || $type == 'All')
                                    <td>{{ $product->user->name }}</td>
                                @endif
                                <td>
                                    <strong>{{ translate('Num of Sale') }}:</strong> {{ $product->num_of_sale }} {{ translate('times') }} </br>
                                    <strong>{{ translate('Base Price') }}:</strong> {{ single_price($product->unit_price) }} </br>
                                    <strong>{{ translate('Rating') }}:</strong> {{ $product->rating }} </br>
                                </td>
                                <td>
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input onchange="update_todays_deal(this)" value="{{ $product->id }}"
                                            type="checkbox" {{ $product->todays_deal ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input onchange="update_published(this)" value="{{ $product->id }}"
                                            type="checkbox" {{ $product->published ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                @if (get_setting('product_approve_by_admin') == 1 && $type == 'Seller')
                                    <td>
                                        <label class="aiz-switch aiz-switch-success mb-0">
                                            <input onchange="update_approved(this)" value="{{ $product->id }}"
                                                type="checkbox" {{ $product->approved ? 'checked' : '' }}>
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                @endif
                                <td>
                                    <label class="aiz-switch aiz-switch-success mb-0">
                                        <input onchange="update_featured(this)" value="{{ $product->id }}"
                                            type="checkbox" {{ $product->featured ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td class="text-right">
                                    @if ($type == 'Seller')
                                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                            href="{{ route('products.seller.edit', ['id' => $product->id, 'lang' => env('DEFAULT_LANGUAGE')]) }}"
                                            title="{{ translate('Edit') }}">
                                            <i class="las la-edit"></i>
                                        </a>
                                    @else
                                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                            href="{{ route('products.admin.edit', ['id' => $product->id, 'lang' => env('DEFAULT_LANGUAGE')]) }}"
                                            title="{{ translate('Edit') }}">
                                            <i class="las la-edit"></i>
                                        </a>
                                    @endif
                                    <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                        data-product-id="{{ $product->id }}"
                                        data-url="{{ route('products.destroy', $product->id) }}"
                                        title="{{ translate('Delete') }}">
                                        <i class="las la-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty 
                        <tr>
                            <td>No Record Found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{-- <div class="aiz-pagination">
                    {{ $products->appends(request()->input())->links() }}
                </div> --}}
            </div>
        </form>
    </div>

@endsection




@section('script')
    <!-- Include jQuery if not already included -->

    <script>
        $(document).ready(function() {
            // Attach a click event handler to the delete button
            $(".confirm-delete").on("click", function(e) {
                e.preventDefault(); // Prevent the default link behavior

                var productId = $(this).data("product-id"); // Get the product ID from the data attribute
                var deleteUrl = $(this).data("url"); // Get the DELETE URL from the data attribute

                // Show a confirmation dialog
                if (confirm("Are you sure you want to delete this product?")) {
                    // Send a DELETE request to delete the product
                    $.ajax({
                        type: "DELETE",
                        url: deleteUrl,
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            // Handle the success response here (e.g., reload the page or remove the deleted element)
                            alert("Product deleted successfully");
                            location.reload(); // Reload the page
                        },
                        error: function(error) {
                            // Handle any errors here
                            alert("Error deleting product");
                        }
                    });
                }
            });
        });
    </script>






    <script type="text/javascript">
        $(document).on("change", ".check-all", function() {
            if (this.checked) {
                // Iterate each checkbox
                $('.check-one:checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('.check-one:checkbox').each(function() {
                    this.checked = false;
                });
            }

        });

        $(document).ready(function() {
            //$('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
        });

        function update_todays_deal(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('products.todays_deal') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Todays Deal updated successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

        function update_published(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('products.published') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Published products updated successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

        function update_approved(el) {
            if (el.checked) {
                var approved = 1;
            } else {
                var approved = 0;
            }
            $.post('{{ route('products.approved') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                approved: approved
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Product approval update successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

        function update_featured(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('products.featured') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Featured products updated successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

        function sort_products(el) {
            $('#sort_products').submit();
        }

        function bulk_delete() {
            var data = new FormData($('#sort_products')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('bulk-product-delete') }}",
                type: 'POST',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response == 1) {
                        location.reload();
                    }
                }
            });
        }
    </script>
@endsection
