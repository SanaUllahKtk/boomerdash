@extends('backend.layouts.app')

@section('content')
    @php
        CoreComponentRepository::instantiateShopRepository();
        CoreComponentRepository::initializeCache();
    @endphp

    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="h3">{{ translate('Login Activities') }}</h1>
            </div>
        </div>
    </div>
    <br>


    <div class="card">

        <div class="card-header row gutters-5">
            <div class="col">
                <h5 class="mb-md-0 h6">{{ translate('Login Activities') }}</h5>
            </div>
            <form class="" id="sort_stores" action="" method="GET">
                <div class="dropdown mb-2 mb-md-0">
                    <button class="btn border dropdown-toggle" type="button" data-toggle="dropdown">
                        {{ translate('Bulk Action') }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#" onclick="bulk_delete()">
                            {{ translate('Delete selection') }}</a>
                    </div>
                </div>
            </form>
            <button class="mx-2 btn btn-primary">Filter</button>
            @if(isset($_GET['country']))
            <a href="{{ route('activitylog.index') }}" class="btn btn-primary">Reset</a>
            @endif

            <a href="{{ route('exportLog.csv') }}" class="btn btn-primary">Export</a>
        </div>




        <div class="card-body">
            <div class="filter">
                <form action="">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="country">Country</label>
                            <select name="country" id="country" class="form-control">
                                <option value="">Select Country</option>
                                @foreach ($countries as $key => $country)
                                    <option value="{{ $key }}" {{ isset($_GET['country']) && $_GET['country'] == $key ? 'selected' : '' }}>{{ $country }}</option>
                                @endforeach
                            </select>
                        </div>
                
                        <div class="col-md-2">
                            <label for="state">State</label>
                            <select name="state" id="state" class="form-control">
                                <option value="">Select State</option>
                                @foreach ($states as $key => $state)
                                    <option value="{{ $key }}" {{ isset($_GET['state']) && $_GET['state'] == $key ? 'selected' : '' }}>{{ $state }}</option>
                                @endforeach
                            </select>
                        </div>
                
                        <div class="col-md-2">
                            <label for="city">City</label>
                            <select name="city" id="city" class="form-control">
                                <option value="">Select City</option>
                                @foreach ($cities as $key => $city)
                                    <option value="{{ $key }}" {{ isset($_GET['city']) && $_GET['city'] == $key ? 'selected' : '' }}>{{ $city }}</option>
                                @endforeach
                            </select>
                        </div>
                
                        <div class="col-md-2">
                            <label for="zipcode">Zipcode</label>
                            <input type="text" class="form-control" name="zipcode" value="{{ isset($_GET['zipcode']) ? $_GET['zipcode'] : '' }}">
                        </div>
                
                        <div class="col-md-2 d-flex">
                            <input type="submit" value="Submit" class="btn btn-primary mt-4">
                        </div>
                    </div>
                </form>                
            </div>

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
                        <th>{{ translate('IP Address') }}</th>
                        <th>{{ translate('Login Date Time') }}</th>
                        <th>{{ translate('Action') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>
                                <div class="form-group d-inline-block">
                                    <label class="aiz-checkbox">
                                        <input type="checkbox" class="check-one" name="id[]"
                                            value="{{ $user->id }}">
                                        <span class="aiz-square-check"></span>
                                    </label>
                                </div>
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->ip }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                @if (\Auth::user()->user_type == 'admin')
                                    <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                        id="confirm-delete" data-log-id="{{ $user->id }}"
                                        data-url="{{ route('activitylog.destroy', $user->id) }}"
                                        title="{{ translate('Delete') }}">
                                        <i class="las la-trash"></i>
                                    </a>
                                @endif



                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
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


        function bulk_delete() {
            var selectedIds = [];
            $('.check-one:checked').each(function() {
                selectedIds.push($(this).val());
            });

            // Confirm before proceeding
            if (confirm("Are you sure you want to delete selected items?")) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('activitylog.bulkDelete') }}",
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
        }


        $(document).ready(function() {
            // Attach a click event handler to the delete button
            $(document).on("click", "#confirm-delete", function(e) {
                e.preventDefault(); // Prevent the default link behavior

                var logId = $(this).data("log-id"); // Get the product ID from the data attribute
                var deleteUrl = $(this).data("url"); // Get the DELETE URL from the data attribute

                // Show a confirmation dialog
                if (confirm("Are you sure you want to delete this activity?")) {
                    // Send a DELETE request to delete the product
                    $.ajax({
                        type: "DELETE",
                        url: deleteUrl,
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            // Handle the success response here (e.g., reload the page or remove the deleted element)
                            alert("Activity deleted successfully");
                            location.reload(); // Reload the page
                        },
                        error: function(error) {
                            // Handle any errors here
                            alert("Error deleting Activity");
                        }
                    });
                }
            });
        });

        $(document).on('change', '[name=country]', function() {
          
          var country_id = $(this).val();
          get_states(country_id);
      });

      $(document).on('change', '[name=state]', function() {
          var state_id = $(this).val();
          get_city(state_id);
      });



        function get_states(country_id) {
            $('[name="state"]').html("");
            $.ajax({
                headers: { 
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('get-state')}}",
                type: 'POST',
                data: {
                    country_id  : country_id
                },
                success: function (response) {
                    var obj = JSON.parse(response);
                    if(obj != '') {
                        $('[name="state"]').html(obj);
                        AIZ.plugins.bootstrapSelect('refresh');
                    }
                }
            });
        }

        function get_city(state_id) {
            $('[name="city"]').html("");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('get-city')}}",
                type: 'POST',
                data: {
                    state_id: state_id
                },
                success: function (response) {
                    var obj = JSON.parse(response);
                    if(obj != '') {
                        $('[name="city"]').html(obj);
                        AIZ.plugins.bootstrapSelect('refresh');
                    }
                }
            });
        }
    </script>
@endsection
