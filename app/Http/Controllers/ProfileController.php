<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    public function home(){
        $userBookings = Auth::user()->bookings;
        return view('home', compact($userBookings));
    }
}
