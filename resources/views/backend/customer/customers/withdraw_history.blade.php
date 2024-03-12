@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="align-items-center">
        <h1 class="h3">{{translate('All Customers Withdraws history')}}</h1>
    </div>
</div>


<div class="card">
      <div class="card-header">
          <h5 class="mb-0 h6">{{ translate('Withdrawal Requests')}}</h5>
      </div>
        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                  <tr>
                      <th>#</th>
                      <th data-breakpoints="lg">{{  translate('Date') }}</th>
                      <td data-breakpoints="lg">Send</td>
                      <th>{{ translate('Customer_name')}}</th>
                      <th>{{ translate('Amount')}}</th>
                      <th class="text-right">{{ translate('Withdraw Status')}}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($wallets as $key => $wallet)
                      <tr>
                          <td>{{ $key+1 }}</td>
                          <td>{{ date('d-m-Y', strtotime($wallet->created_at)) }}</td>
                          <td><a href="{{route('customers.pay_customer', encrypt($wallet->id))}}"  class="btn btn-success" style="border:none;">Send Money 💵 </a></td>
                          <td>{{ $wallet->user_name }}</td>
                          <td>{{ single_price($wallet->withdraw_amount) }}</td>
                          <td class="text-right">
                            
                                  @if ($wallet->withdraw_status === 1)
                                      <span class="badge badge-inline badge-success">{{translate('Approved')}}</span>
                                  @else
                                      <span class="badge badge-inline badge-danger">{{translate('Pending')}}</span>
                                  @endif
                             
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
          <h5 class="mb-0 h6">{{ translate('Withdrawal history')}}</h5>
      </div>
        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                  <tr>
                      <th>{{ translate('Customer_name')}}</th>
                      <th>{{ translate('Amount')}}</th>
                      <th class="text-right">{{ translate('Withdraw Status')}}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach (\App\Models\WithdrawalHistoryUser::all() as $key => $wallet)
                      <tr>
                          <td>{{ $wallet->user_name }}</td>
                          <td>{{ single_price($wallet->withdraw_amount) }}</td>
                          <td class="text-right">
                            
                            
                                  @if ($wallet->withdraw_status != "Pending")
                                      <span class="badge badge-inline badge-success">{{translate('Approved')}}</span>
                                  @else
                                      <a href="{{route('customers.paypal_status', $wallet->id)}}" class="btn btn-primary">verify</a>
                                  @endif
                             
                          </td>
                      </tr>
                  @endforeach

                </tbody>
            </table>
        </div>
    </div>


@endsection

