@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="align-items-center">
            <h1 class="h3">{{ translate('All Customers Withdraws history') }}</h1>
        </div>
    </div>


    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{ translate('Withdrawal Requests') }}</h5>
        </div>
        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th data-breakpoints="lg">{{ translate('Date') }}</th>
                        <td data-breakpoints="lg" class="d-none">Send</td>
                        <th>{{ translate('Customer_name') }}</th>
                        <th>{{ 'ID Card' }}</th>
                        <th>{{ translate('Amount') }}</th>
                        <th class="text-right">{{ translate('Withdraw Status') }}</th>
                        <th class="text-right">{{ translate('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wallets as $key => $wallet)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ date('d-m-Y', strtotime($wallet->created_at)) }}</td>
                            <td class="d-none"><a href="{{ route('customers.pay_customer', encrypt($wallet->id)) }}"
                                    class="btn btn-success" style="border:none;">Send Money 💵 </a></td>
                            <td>{{ $wallet->user_name }}</td>
                            <td>
                                @if (!empty($wallet->id_card))
                                    <a href="{{ uploaded_asset($wallet->id_card) }}" target="_blank">
                                        <img src="{{ uploaded_asset($wallet->id_card) }}" alt="" width="50px"
                                            height="auto">
                                    </a>
                                @endif
                            </td>
                            <td>{{ single_price($wallet->withdraw_amount) }}</td>
                            <td class="text-right">

                                @if ($wallet->withdraw_status === 1)
                                    <span class="badge badge-inline badge-success">{{ translate('Approved') }}</span>
                                @else
                                    <span class="badge badge-inline badge-danger">{{ translate('Pending') }}</span>
                                @endif

                            </td>

                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" data-id="{{ $wallet->id }}" onclick="showModal({{ $wallet->id }})" class="btn btn-sm btn-primary float-right" data-toggle="modal"
                                    data-target="#exampleModal">
                                    Update Status
                                </button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="aiz-pagination">
                {{ $wallets->links() }}
            </div>
        </div>
    </div>

    <div class="card mt-2">
        <div class="card-header">
            <h5 class="mb-0 h6">{{ translate('Withdrawal history') }}</h5>
        </div>
        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                    <tr>
                        <th>{{ translate('Customer_name') }}</th>
                        <th>{{ translate('Amount') }}</th>
                        <th class="text-right">{{ translate('Withdraw Status') }}</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach (\App\Models\WithdrawalHistoryUser::all() as $key => $wallet) --}}
                    @foreach (\App\Models\Withdrawal::where('withdraw_status', 1)->get() as $key => $wallet)
                        <tr>
                            <td>{{ $wallet->user_name }}</td>
                            <td>{{ single_price($wallet->withdraw_amount) }}</td>
                            <td class="text-right">


                                @if ($wallet->withdraw_status != 'Pending')
                                    <span class="badge badge-inline badge-success">{{ translate('Approved') }}</span>
                                @else
                                    <a href="{{ route('customers.paypal_status', $wallet->id) }}"
                                        class="btn btn-primary">verify</a>
                                @endif

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('update.status') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Update Status</label>
                            <select name="status" id="" class="form form-control">
                                <option value="">Select Status</option>
                                <option value="0">Pending</option>
                                <option value="2">Denied</option>
                                <option value="1">Approved</option>
                            </select>
                        </div>

                        <input type="hidden" id="withdrawal_id" name="id" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("script")
<script>
    function showModal(id){
        $("#withdrawal_id").val(id);
    }
</script>
@endsection