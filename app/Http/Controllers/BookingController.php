<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BookingController extends Controller
{
    //
    public function create(){
        return view('bookings.create');
    }
    public function store(Request $request){
        $user = Auth::user();
        $validated = $request->validate([
            'destination' => ['required', 'string'],
            'item_name' => ['required', 'string'],
            'item_quantity' => ['required', 'integer']
        ]);

        $booking = new Booking([
            'destination' => $validated['destination'],
            'item_name' => $validated['item_name'],
            'item_quantity' => $validated['item_quantity']
        ]);

        $booking->user()->associate($user);
        $booking->save();

        session()->flash('booking_success', 'Booking confirmed successfully!');
        return redirect()->route('home');

    }
    public function view($booking_id){
        $booking = Booking::with('ride')->findOrFail($booking_id);
        $rider = User::where('id', optional($booking->ride)->rider_id)->first();
        return view('bookings.view', compact('booking', 'rider'));
    }

    public function complete(Request $request){
        if(!Gate::allows('isUser')){
            abort(403);
        }
        
        $validated = $request->validate([
            'booking_id' => ['required', 'integer']
        ]);

        $booking = Booking::findOrFail($validated['booking_id']);
        $booking->update([
            'completed' => true
        ]);
        session()->flash('booking_completed', 'You accepted this item and booking has been completed');
        return redirect()->back();
    }
}
