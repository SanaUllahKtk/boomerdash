<?php

namespace App\Http\Controllers;

use App\Models\CashbackRequest;
use App\Models\ClubPoint;
use App\Models\User;
use Illuminate\Http\Request;

class CashbackRequestController extends Controller
{
    public function index(){
        $cashbacks = CashbackRequest::where('status', 1)->get();
        $users = User::pluck('name', 'id')->toArray();
        return view('backend.cashbackrequests.index', compact('cashbacks', 'users'));
    }


    //
    public function store(Request $request){
        //dd($request->input());

        $cashback = new CashbackRequest();
        $cashback->store_id = $request->store_id;
        $cashback->order_total = $request->total;
        $cashback->order_date = $request->order_date;
        $cashback->user_id = \Auth::user()->id;
        $cashback->status = 1;
        $cashback->created_at = date('Y-m-d h:i:s');
        $cashback->updated_at = date('Y-m-d h:i:s');
        $cashback->save();

        return redirect()->route('stores.show', $request->store_id)->with('success', 'Cash Back Request sent successfully.');
    }

    public function pay(Request $request){
        
        $point = new ClubPoint();
        $point->user_id = $request->user_id;
        $point->point_type = 'Cash Back';
        $point->points = $request->points;
        $point->order_id = 'c'.time();
        $point->convert_status = 0;
        $point->created_at = date('Y-m-d h:i:s');
        $point->updated_at = date('Y-m-d h:i:s');
        $point->save();


        CashbackRequest::where('id', $request->request_id)->update(['status' => 0]);

        return redirect()->back()->with('success', 'Point paid');
    }
}
