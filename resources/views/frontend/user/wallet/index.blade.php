@extends('frontend.layouts.user_panel')

@section('panel_content')
    <div class="aiz-titlebar mt-2 mb-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">{{ translate('My Wallet') }}</h1>
            </div>
        </div>
    </div>
    <div class="row gutters-10">
        <div class="col-md-4 mx-auto mb-3">
            <div class="bg-grad-1 text-white rounded-lg overflow-hidden" data-balance="{{ single_price(Auth::user()->balance) }}" onclick="show_wallet_modal()"
                style="cursor: pointer; background: linear-gradient(90deg, rgba(125,37,140,1) 12%, rgba(38,99,242,1) 32%, rgba(54,115,255,1) 42%, rgba(250,237,46,1) 66%, rgba(245,153,41,1) 81%, rgba(217,36,37,1) 99%);">
                <span
                    class="size-30px rounded-circle mx-auto bg-soft-primary d-flex align-items-center justify-content-center mt-3">
                    <i class="las la-dollar-sign la-2x text-white"></i>
                </span>
                <div class="px-3 pt-3 pb-3">
                    <div class="h4 fw-700 text-center">{{ single_price(Auth::user()->balance) }}</div>
                    <div class="opacity-50 text-center">{{ translate('Wallet Balance') }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mx-auto mb-3">
            @if (!empty(\Auth::user()->card_photo))
                <img src="{{ uploaded_asset(\Auth::user()->card_photo) }}" alt="" width="83%" height="100%">
            @else
                <img src="{{ static_asset('card1.png') }}" alt="" class="" width="83%" height="100%">
            @endif
        </div>
        <div class="col-md-4 mx-auto mb-3">

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
                        <th>{{ translate('Amount') }}</th>
                        <!--<th data-breakpoints="lg">{{ translate('Payment Method') }}</th>-->
                        <th class="text-right">{{ translate('Withdraw Status') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wallets as $key => $wallet)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ date('d-m-Y', strtotime($wallet->created_at)) }}</td>
                            <td>{{ single_price($wallet->withdraw_amount) }}</td>
                            <!--<td>{{ ucfirst(str_replace('_', ' ', $wallet->payment_method)) }}</td>-->
                            <td class="text-right">

                                @if ($wallet->withdraw_status === 1)
                                    <span class="badge badge-inline badge-success">{{ translate('Approved') }}</span>
                                @else
                                    <span class="badge badge-inline badge-danger">{{ translate('Pending') }}</span>
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



    <div class="card mt-3">
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
                    {{-- @foreach (\App\Models\WithdrawalHistoryUser::where('user_id', Auth::user()->id)->where('withdraw_status', '!=', 'Pending')->get() as $key => $wallet) --}}
                    @foreach (\App\Models\Withdrawal::where('user_id', Auth::user()->id)->where('withdraw_status', '!=', 0)->get() as $key => $wallet)    
                        <tr>
                            <td>{{ $wallet->user_name }}</td>
                            <td>{{ single_price($wallet->withdraw_amount) }}</td>
                            <td class="text-right">
                                <span class="badge badge-inline badge-success">{{ translate('Approved') }}</span>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal fade" id="wallet_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ translate('Withdraw Wallet') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="" action="{{ route('user.withdrawalRequest') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="text" lang="en" class="form-control mb-3" name="amount"
                        value="{{ Auth::user()->balance }}" placeholder="{{ Auth::user()->balance }}">
                    </div>
                    <input type="hidden" lang="en" class="form-control mb-3" name="userid"
                        value="{{ Auth::user()->id }}" placeholder="{{ Auth::user()->id }}">
                    <input type="hidden" lang="en" class="form-control mb-3" name="user_name"
                        value="{{ Auth::user()->name }}" placeholder="{{ Auth::user()->name }}">
                    {{-- <input type="email" lang="en" class="form-control mb-3" required="required" name="paypal_email"
                        placeholder="Enter your paypal Email"> --}}

                    <div class="col-md-12">
                        <label for="">Upload Valid ID</label>
                        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium">
                                    {{ translate('Browse') }}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="photos" class="selected-files">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                        <small
                            class="text-muted">{{ translate('These images are visible in product details page gallery. Use 600x600 sizes images.') }}</small>
                    </div>

                    <div class="form-group col-md-12">
                        <input type="checkbox" class="" required>
                        <span>I confirm all profile information such as mailing address, phone number and date of birth is up to date. Rewards debit card will be mailed using the information on file.</span>
                    </div>
                    <div class="form-group text-center m-3">
                        <button type="submit"
                            class="btn btn-lg btn-primary transition-3d-hover mr-1">{{ translate('Withdraw') }}</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>


    <!-- offline payment Modal -->
    <div class="modal fade" id="offline_wallet_recharge_modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ translate('Offline Recharge Wallet') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="offline_wallet_recharge_modal_body"></div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        function show_wallet_modal() {
            $('#wallet_modal').modal('show');
        }

        function show_make_wallet_recharge_modal() {
            $.post('{{ route('offline_wallet_recharge_modal') }}', {
                _token: '{{ csrf_token() }}'
            }, function(data) {
                $('#offline_wallet_recharge_modal_body').html(data);
                $('#offline_wallet_recharge_modal').modal('show');
            });
        }
    </script>
@endsection
