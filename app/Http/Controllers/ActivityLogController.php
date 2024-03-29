<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\LoginActivity;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    //
    public function index(){
        $users_query = User::select(['users.name', 'login_activities.*'])->join('login_activities', 'login_activities.user_id', '=', 'users.id');

        if(isset($_GET['country']) && !empty($_GET['country'])){
            $users_query->where('country', $_GET['country']);
        }

        $states = [];
        if(isset($_GET['state']) && !empty($_GET['state'])){
            $users_query->where('state', $_GET['state']);
            $states = State::where('id', $_GET['state'])->pluck('name', 'id')->toArray();;
        }

        $cities = [];
        if(isset($_GET['city']) && !empty($_GET['city'])){
            $users_query->where('city', $_GET['city']);
            $cities = City::where('id', $_GET['city'])->pluck('name', 'id')->toArray();
        }

        if(isset($_GET['zipcode']) && !empty($_GET['zipcode'])){
            $users_query->where('postal_code', $_GET['zipcode']);
        }

       
        $users = $users_query->get();
       
       
        $countries = Country::pluck('name', 'id')->toArray();

        return view('backend.report.loginActivities', compact('users', 'countries', 'states', 'cities'));
    }


    public function destroy($id){
        LoginActivity::findOrFail($id)->delete();
        return 1;
    }

    public function bulkdelete(Request $request){
        if ($request->ids) {
            foreach ($request->ids as $id) {
                LoginActivity::findOrFail($id)->delete();
            }
        }

        return 1;
    }
}
