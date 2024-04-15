@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col-auto">
                <h1 class="h3">{{ translate('All Reports') }}</h1>
            </div>
        </div>
    </div>
    <br>


    <div class="card">
        <form class="" id="sort_stores" action="" method="GET">
            <div class="card-header row gutters-5">
                <div class="col">
                    <h5 class="mb-md-0 h6">{{ translate('All Reports') }}</h5>
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
            </div>
        </form>



        <div class="card-body">
           
                <div class="filter">
                    <form action="">
                         <div class="row">
                            <div class="form-group col-md-3">
                                <select name="status" id="" class="form form-control">
                                    <option value="">Select Status</option>
                                    <option value="pending" {{ !isset($_GET['status']) || (isset($_GET['status']) && $_GET['status'] == 'pending') ? 'selected' : ''}}>Pending</option>
                                    <option value="completed" {{ isset($_GET['status']) && $_GET['status'] == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                             </div>
    
                             <div class="col-md-3">
                                <input type="submit" value="Submit" class="btn btn-primary">
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

                        <th>{{ translate('Description') }}</th>
                        <th>{{ translate('Type') }}</th>
                        <th>{{ translate('Created By') }}</th>
                        <th>{{ translate('Post') }}</th>
                        <th>{{ translate('Status') }}</th>
                        <th>{{ translate('Action') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($reports as $report)
                        @php 
                          if(!isset($posts[$report->postId])){
                            continue;
                          }
                        @endphp 
                        <tr>
                            <td>
                                <div class="form-group d-inline-block">
                                    <label class="aiz-checkbox">
                                        <input type="checkbox" class="check-one" name="id[]"
                                            value="{{ $report->id }}">
                                        <span class="aiz-square-check"></span>
                                    </label>
                                </div>
                            </td>
                            <td>{{ $report->description }}</td>
                            <td>{{ $report->type }}</td>
                            <td>{{ $users[$report->created_by] ?? '' }}</td>
                            <td>{{ $posts[$report->postId] ?? '' }}</td>
                            <td>{{ ucfirst($report->status) }}</td>
                            <td>
                                @if (\Auth::user()->user_type == 'admin')
                                    <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                        id="confirm-delete" data-report-id="{{ $report->id }}"
                                        data-url="{{ route('r_reports.destroy', ['r_report' => $report]) }}"
                                        title="{{ translate('Delete') }}">
                                        <i class="las la-trash"></i>
                                    </a>

                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                        href="{{ route('r_posts.show', ['r_post' => $report->postId]) }}"
                                        title="{{ translate('Show Post') }}">
                                        <i class="las la-eye"></i>
                                    </a>

                                    <!-- Button trigger modal -->
                                    <button type="button" onclick="showModal({{ $report->id }})" data-report-id="{{ $report->id }}" class="btn btn-sm btn-circle btn-soft-danger btn-icon" data-toggle="modal"
                                        data-target="#exampleModal">
                                        <i class="las la-edit"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Action</h5>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="updateForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    
                         <div class="form-group">
                            <label for="">Action</label>
                            <select name="action" id="" class="form form-control">
                                <option value="">Select Action</option>
                                <option value="reviewCompleted">Review Completed</option>
                                <option value="deletePost">Delete Post</option>
                                <option value="banUser">Ban User</option>
                            </select>

                            <input type="hidden" value="" name="reportId" id="reportId">
                         </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            </div>
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


        function bulk_delete() {
            var selectedIds = [];
            $('.check-one:checked').each(function() {
                selectedIds.push($(this).val());
            });

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('bulk-posts-delete') }}",
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

                var reportId = $(this).data("report-id"); // Get the product ID from the data attribute
                var deleteUrl = $(this).data("url"); // Get the DELETE URL from the data attribute

                // Show a confirmation dialog
                if (confirm("Are you sure you want to delete this report?")) {
                    // Send a DELETE request to delete the product
                    $.ajax({
                        type: "DELETE",
                        url: deleteUrl,
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            // Handle the success response here (e.g., reload the page or remove the deleted element)
                            alert("Report deleted successfully");
                            location.reload(); // Reload the page
                        },
                        error: function(error) {
                            // Handle any errors here
                            alert("Error deleting report");
                        }
                    });
                }
            });
        });


        function showModal(id){
            $("#updateForm").attr('action', '/r_reports/'+id);
        }
    </script>
@endsection
