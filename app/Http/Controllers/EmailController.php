<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function welcomeEmail(Request $request)
    {
        Mail::to(auth()->user()->email)->send(new WelcomeEmail());

        return response()->json(['message' => 'Email sent successfully']);
    }
}
