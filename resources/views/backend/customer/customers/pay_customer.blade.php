@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <div class="align-items-center">
        <h1 class="h3">{{translate('Pay Customers')}}</h1>
    </div>
</div>

<div class="card" style="margin:0 auto; width:50%;">
          <div class="card-header">
          <h5 class="mb-0 h6">{{ translate('Send Money')}}</h5>
      </div>
        <div class="card-body">
<form method="POST" action="{{route('customers.paypal_form')}}"  class="mb-0">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <input type="hidden" name="user_id" value="{{$wallets->user_id}}" />
    <input type="hidden" name="user_name" value="{{$wallets->user_name}}" />

  <div class="form-group">
    <label for="emailInput">Receiver Email</label>
    <input type="email" name="paypal_email"  value="{{$wallets->paypal_email}}" class="form-control" id="emailInput" aria-describedby="emailHelp" required>
  </div>
  <!--<div class="form-group">-->
  <!--  <label for="emailInput">Sender Email</label>-->
  <!--  <input type="email" name="sender_email" class="form-control" id="emailInput" aria-describedby="emailHelp" required placeholder="Enter email">-->
  <!--</div>-->
  <div class="form-group">
    <label for="amountInput">Amount</label>
    <input type="number" name="amount" class="form-control" id="amountInput" value="{{$wallets->withdraw_amount}}" required >
  </div>
  
  
  
  @if($wallets->withdraw_amount <= 0)
  <button type="submit" class="btn btn-primary" disabled >Send</button>
  @else
    <button type="submit" class="btn btn-primary" >Send</button>
  @endif
</form>
</div>
</div>


<div class="card m-3">
      <div class="card-header">
          <h5 class="mb-0 h6">{{ translate('Wallet Withdrawal History')}}</h5>
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
                  @foreach (\App\Models\WithdrawalHistoryUser::where('user_id',  $wallets->user_id)->get() as $key => $wallet)
                      <tr>
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
        </div>
    </div>

@endsection
<script>
  const form = document.querySelector('form');
  const emailInput = form.querySelector('#emailInput');
  const amountInput = form.querySelector('#amountInput');

  form.addEventListener('submit', (e) => {
    e.preventDefault();

    const email = emailInput.value;
    const amount = amountInput.value;

    if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      alert('Please enter a valid email address.');
      return;
    }

    if (!amount || isNaN(amount) || amount <= 0) {
      alert('Please enter a valid amount.');
      return;
    }

    // Code to submit form data here
    alert(`Email: ${email}\nAmount: ${amount}`);
  });
</script>
