@extends('backend.layouts.app')

@section('content')
    @php
        CoreComponentRepository::instantiateShopRepository();
        CoreComponentRepository::initializeCache();
    @endphp

    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="h3">{{ translate('All Cash Back Requests') }}</h1>
            </div>
            @if (\Auth::user()->user_type == 'admin')
                <div class="col text-right">
                    <a href="{{ route('stores.create') }}" class="btn btn-circle btn-info">
                        <span>{{ translate('Add New Store') }}</span>
                    </a>
                </div>
            @endif
        </div>
    </div>
    <br>


    <div class="card">
        <form class="" id="sort_stores" action="" method="GET">
            <div class="card-header row gutters-5">
                <div class="col">
                    <h5 class="mb-md-0 h6">{{ translate('All Cash Back Requests') }}</h5>
                </div>
            </div>
        </form>



        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                    <tr>
                        <th>{{ translate('Seller Name') }}</th>
                        <th>{{ translate('Order Total') }}</th>
                        <th>{{ translate('Order Date') }}</th>
                        <th>{{ translate('Status') }}</th>
                        <th>{{ translate('Action') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($cashbacks as $cashback)
                        <tr>

                            <td>{{ $users[$cashback->user_id] ?? '' }}</td>
                            <td>{{ $cashback->order_total }}</td>
                            <td>{{ $cashback->order_date }}</td>
                            <td>{{ $cashback->status == 1 ? 'Not Paid' : 'Paid' }}</td>
                            <td>
                                @if (\Auth::user()->user_type == 'admin')
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary pay-points" data-toggle="modal"
                                        data-target="#exampleModalLong" data-cashback-id="{{ $cashback->id }}" data-user-id="{{ $cashback->user_id }}">
                                        Pay
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Pay</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('cashbackrequest.pay') }}" method="post" class="">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Points</label>
                            <input type="number" class="form form-control" name="points" value="" required>
                        </div>

                        <div class="form-group">
                            <input type="hidden" value="" id="request_id" name="request_id">
                            <input type="hidden" value="" id="user_id" name="user_id">
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


@section('script')
    <script>
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

        $(document).on("click", ".pay-points", function(){
            var request_id = $(this).data('cashback-id');
            var user_id = $(this).data('user-id');
            $("#request_id").val(request_id);
            $("#user_id").val(user_id);
        })


        function bulk_delete() {
            var selectedIds = [];
            $('.check-one:checked').each(function() {
                selectedIds.push($(this).val());
            });

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('bulk-stores-delete') }}",
                type: 'POST',
                data: {
                    ids: selectedIds
                }, // Pass selectedIds array as data
                success: function(response) {
                    if (response == 1) {
                        location.reload();
                    }
                }
            });
        }

        $(document).ready(function() {
            // Attach a click event handler to the delete button
            $(document).on("click", "#confirm-delete", function(e) {
                e.preventDefault(); // Prevent the default link behavior

                var storeId = $(this).data("store-id"); // Get the product ID from the data attribute
                var deleteUrl = $(this).data("url"); // Get the DELETE URL from the data attribute

                // Show a confirmation dialog
                if (confirm("Are you sure you want to delete this store?")) {
                    // Send a DELETE request to delete the product
                    $.ajax({
                        type: "DELETE",
                        url: deleteUrl,
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            // Handle the success response here (e.g., reload the page or remove the deleted element)
                            alert("Store deleted successfully");
                            location.reload(); // Reload the page
                        },
                        error: function(error) {
                            // Handle any errors here
                            alert("Error deleting store");
                        }
                    });
                }
            });
        });
    </script>
@endsection
