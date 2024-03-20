<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Withdrawal;
use App\Models\Paypal;
use App\Models\User;
use Redirect;
use App\Models\WithdrawalHistoryUser;
use App\Models\Order;
use App\Models\City;
use App\Models\Country;
use App\Models\State;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $users = User::where('user_type', 'customer')->where('email_verified_at', '!=', null)->orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $users->where(function ($q) use ($sort_search){
                $q->where('name', 'like', '%'.$sort_search.'%')->orWhere('email', 'like', '%'.$sort_search.'%');
            });
        }
        $users = $users->paginate(15);

        $countries = Country::pluck('name', 'id')->toArray();
        $states = State::pluck('name', 'id')->toArray();
        $cities = City::pluck('name', 'id')->toArray();


        return view('backend.customer.customers.index', compact('users', 'sort_search', 'countries', 'states', 'cities'));
    }
    
    public function withdraw_history(Request $request)
        {
            $wallets = Withdrawal::where('withdraw_status', '!=', 1)->latest()->paginate(9);
            return view('backend.customer.customers.withdraw_history', compact('wallets'));
        }
        
        public function pay_customer(Request $request,$id)
        {
            
            $wallets = Withdrawal::where('id','=',decrypt($id))->first();
            return view('backend.customer.customers.pay_customer', compact('wallets'));
        }    
        public function paypal_status(Request $request,$id)
        {
                   
              
                $client_id = 'AfdthsuHG_DzLSbaJ03gYqUhUXjR1IP6Ydwn-llVc_32XyP_RhXLfPP96X1zX2Y7rslsn6A4cimYSqRM';
                $client_secret = 'EB4uNigYdcY6fHXsL6Juyh5O1HHDp8YGkZ6uc8H8HLxmByHRnVRzXWeZmnxF3Me0ODW0JL0H71qjWbDQ';
                
                
                
                // $client_id = 'AWB3R8_a_rFpa7gHkTWzN5X949E9h4D_MzrSE0WNopko7By64L_blhoiJjBtU5rdtn1uc6o8RqkH-mGx';
                // $client_secret = 'EIGDK6xXzSilJjPzMR-zUIFYHVbxFuAjhuMm3XefAiOV9w1SGZvtZ9fGeWUooztBo-Z1qpsus0wFlsS2';
                $credentials = base64_encode($client_id.':'.$client_secret);
                
              
                    
                    $curl = curl_init();

                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'https://api-m.paypal.com/v1/oauth2/token',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => 'grant_type=client_credentials&ignoreCache=true&return_authn_schemes=true&return_client_metadata=true&return_unconsented_scopes=true',
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded',
                    'Authorization: Basic '. $credentials,
                  ),
                ));
                
                $response = curl_exec($curl);
                curl_close($curl);
                $access_token = json_decode($response)->access_token;  
                  
                        $batch_id=WithdrawalHistoryUser::where('id', $id)->first()->batch_id;
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api-m.paypal.com/v1/payments/payouts/'.$batch_id,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$access_token
  ),
));

$response = curl_exec($curl);

curl_close($curl);
    
     $responseArray = json_decode($response, true);
                
                // Access the payout_batch_id value
            $batchstatus = $responseArray['batch_header']['batch_status'];
                
                if($batchstatus == 'SUCCESS'){
                
                   WithdrawalHistoryUser::where('id', $id)->update(['withdraw_status'=>'SUCCESS']);
                   flash(translate("your status is successfully approved."))->success();
        return Redirect::back();
                }
                else{
                    flash(translate("your status is not approved yet, try agian later."))->danger();
        return Redirect::back();
                }
        }    

        
        public function paypal_form (Request $request)
        {
                // if(User::where('id', $request->user_id)->first()->balance >= $request->amount){
                $client_id = 'AfdthsuHG_DzLSbaJ03gYqUhUXjR1IP6Ydwn-llVc_32XyP_RhXLfPP96X1zX2Y7rslsn6A4cimYSqRM';
                $client_secret = 'EB4uNigYdcY6fHXsL6Juyh5O1HHDp8YGkZ6uc8H8HLxmByHRnVRzXWeZmnxF3Me0ODW0JL0H71qjWbDQ';
                // $client_id = 'AWB3R8_a_rFpa7gHkTWzN5X949E9h4D_MzrSE0WNopko7By64L_blhoiJjBtU5rdtn1uc6o8RqkH-mGx';
                // $client_secret = 'EIGDK6xXzSilJjPzMR-zUIFYHVbxFuAjhuMm3XefAiOV9w1SGZvtZ9fGeWUooztBo-Z1qpsus0wFlsS2';
                $credentials = base64_encode($client_id.':'.$client_secret);
                // $sender_email = 'umairshaukat278@gmail.com';
                
                $users = User::where('id', $request->user_id)->where('email_verified_at', '!=', null)->first();
                $receiver_email =  $request->paypal_email;
                // $receiver_email = 'umairshaukat278@gmail.com';
                $amount = $request->amount; // Amount to send
                    // Create an access token
                    
                    $curl = curl_init();

                curl_setopt_array($curl, array(
                  CURLOPT_URL => 'https://api-m.paypal.com/v1/oauth2/token',
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => '',
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 0,
                  CURLOPT_FOLLOWLOCATION => true,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => 'POST',
                  CURLOPT_POSTFIELDS => 'grant_type=client_credentials&ignoreCache=true&return_authn_schemes=true&return_client_metadata=true&return_unconsented_scopes=true',
                  CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded',
                    'Authorization: Basic '. $credentials,
                  ),
                ));
                
            $response = curl_exec($curl);
             
                
                
                $access_token = json_decode($response)->access_token;
                                
                $ch = curl_init();
                $headers = array(
                    'Content-Type: application/json',
                    'Authorization: Bearer '.$access_token
                );
                
                $data = array(
                    "sender_batch_header" => array(
                        "sender_batch_id" => "Payouts_0020_".date('m-d-Y_H:i:s'),
                        "email_subject" => "You have a payout!",
                        "email_message" => "You have received a payout! Thanks for using our service!"
                    ),
                    "items" => array(
                        array(
                            "recipient_type" => "EMAIL",
                            "amount" => array(
                                "value" => (float)$amount,
                                "currency" => "USD"
                            ),
                            "note" => "Thanks for your patronage!",
                            "sender_item_id" => "201463".date('m-d-Y_H:i:s'),
                            "receiver" => $receiver_email,
                            "recipient_wallet" => "PAYPAL"
                        )
                    )
                );
                
                 $options = array(
                    CURLOPT_URL => 'https://api-m.paypal.com/v1/payments/payouts',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => json_encode($data),
                    CURLOPT_HTTPHEADER => $headers
                );
                // return $headers;
                curl_setopt_array($ch, $options);
                $response = curl_exec($ch);
                
                curl_close($ch);
                
                $responseArray = json_decode($response, true);
                if(isset($responseArray['name']) && $responseArray['name']=='INSUFFICIENT_FUNDS'){
                flash(translate($responseArray['message']))->error();
                return Redirect::back();
                }
                // Access the payout_batch_id value
                if (!isset($responseArray['batch_header'])){
                flash(translate($responseArray['message']))->error();
                return Redirect::back();
                }
                $payoutBatchId = $responseArray['batch_header']['payout_batch_id'];
                if(!empty($payoutBatchId)){
                        $user_data = User::where('id', $request->user_id)->first();
                        // $total = $user_data->balance - $request->amount;
                        // User::where('id', $request->user_id)->update(['balance'=>$total]);
                        Withdrawal::where('user_id', $request->user_id)->update(['withdraw_amount'=> 0, 'withdraw_status'=>1]);
                        $wallet = new WithdrawalHistoryUser;
                        $wallet->user_id =  $request->user_id;
                        $wallet->user_name =  $request->user_name;
                        $wallet->withdraw_amount = $request->amount;
                        $wallet->batch_id = $payoutBatchId;
                        $wallet->withdraw_status = 'Pending';
                        $wallet->save();
    flash(translate("Customer has been credited balance"))->success();
        return Redirect::back();
                }
// }
// else{
//   $wallets = Withdrawal::where('user_id','=',$request->user_id)->first();
//     flash(translate("Customer Don't have the so much balance"))->danger();
//         return Redirect::back();
// }
                        


        }   
        
    
    
    // withdraw
    public function withdraw(Request $request)
    {
        $sort_search = null;
        $users = User::where('user_type', 'customer')->where('email_verified_at', '!=', null)->orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $users->where(function ($q) use ($sort_search){
                $q->where('name', 'like', '%'.$sort_search.'%')->orWhere('email', 'like', '%'.$sort_search.'%');
            });
        }
        $users = $users->paginate(15);
        return view('backend.customer.customers.withdraw', compact('users', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'email'         => 'required|unique:users|email',
            'phone'         => 'required|unique:users',
        ]);
        
        $response['status'] = 'Error';
        
        $user = User::create($request->all());
        
        $customer = new Customer;
        
        $customer->user_id = $user->id;
        $customer->save();
        
        if (isset($user->id)) {
            $html = '';
            $html .= '<option value="">
                        '. translate("Walk In Customer") .'
                    </option>';
            foreach(Customer::all() as $key => $customer){
                if ($customer->user) {
                    $html .= '<option value="'.$customer->user->id.'" data-contact="'.$customer->user->email.'">
                                '.$customer->user->name.'
                            </option>';
                }
            }
            
            $response['status'] = 'Success';
            $response['html'] = $html;
        }
        
        echo json_encode($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        flash(translate('Customer has been deleted successfully'))->success();
        return redirect()->route('customers.index');
    }
    
    public function bulk_customer_delete(Request $request) {
        if($request->id) {
            foreach ($request->id as $customer_id) {
                $this->destroy($customer_id);
            }
        }
        
        return 1;
    }

    public function login($id)
    {
        $user = User::findOrFail(decrypt($id));

        auth()->login($user, true);

        return redirect()->route('dashboard');
    }

    public function ban($id) {
        $user = User::findOrFail(decrypt($id));

        if($user->banned == 1) {
            $user->banned = 0;
            flash(translate('Customer UnBanned Successfully'))->success();
        } else {
            $user->banned = 1;
            flash(translate('Customer Banned Successfully'))->success();
        }

        $user->save();
        
        return back();
    }
    public function paypal(Request $request){
    }
}
