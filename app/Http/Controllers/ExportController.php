<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use App\Models\User;

class ExportController extends Controller
{
    public function exportLog()
    {
        // Your query to retrieve data
        $users_query = User::select(['users.name', 'users.country', 'users.state', 'users.city', 'users.postal_code', 'login_activities.ip', 'login_activities.created_at'])
            ->join('login_activities', 'login_activities.user_id', '=', 'users.id');

        // Apply filters if needed
        if (isset($_GET['country']) && !empty($_GET['country'])) {
            $users_query->where('users.country', $_GET['country']);
        }
        // Apply other filters similarly

        // Fetch the data
        $users = $users_query->get();

        $countries = Country::pluck('name', 'id')->toArray();
        $states = State::pluck('name', 'id')->toArray();
        $cities = City::pluck('name', 'id')->toArray();

        // Create CSV content
        $csv = 'Name, Country, State, City, Zipcode, IP Address, Login Date Time' . PHP_EOL;
        foreach ($users as $user) {
            $csv .= '"' . $user->name . '","' . ($countries[$user->country] ?? '') . '","' . ($states[$user->state] ?? '') . '","' . ($cities[$user->city] ?? '') . '","' . $user->postal_code . '","' . $user->ip . '","' . $user->created_at->format('Y-m-d H:i:s') . '"' . PHP_EOL;
        }

        // Set the headers to force download the CSV file
        return Response::make($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="export.csv"',
        ]);
    }

    public function exportCustomerLog()
    {
        $users = User::where('user_type', 'customer')->whereNotNull('email_verified_at')->orderBy('created_at', 'desc')->get();
        $countries = Country::pluck('name', 'id')->toArray();
        $states = State::pluck('name', 'id')->toArray();
        $cities = City::pluck('name', 'id')->toArray();

        // Create CSV content
        $csv = 'Name, Email, Country, State, City, Postal Code, Address' . PHP_EOL;
        foreach ($users as $user) {
            $csv .= '"' . $user->name . '","' . $user->email . '",' . ($countries[$user->country] ?? '') . ',"' . ($states[$user->state] ?? '') . '","' . ($cities[$user->city] ?? '') . '","' . $user->postal_code . '","' . str_replace('"', '""', $user->st_address) . '"' . PHP_EOL;
        }

        // Set the headers to force download the CSV file
        return Response::make($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="export.csv"',
        ]);
    }
}
