<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $playerName = $request->input('player_name');
        $playerEmail = $request->input('player_email');
        $message = $request->input('message');

        // Send email
        Mail::send([], [], function ($msg) use ($playerName, $playerEmail, $message) {
            $msg->to('info@boomerdash.com') // Set the recipient email address
                ->subject('New Email from Player')
                ->setBody("
                    Player Name: $playerName\n
                    Player Email: $playerEmail\n
                    Message: $message
                ");
        });

        return redirect()->back()->with('success', 'Email sent successfully!');
    }
}
