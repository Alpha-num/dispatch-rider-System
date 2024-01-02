<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class RidesController extends Controller
{
    
    public function index(){
        $bookings = Booking::all();
        return view('rides.index', compact('bookings'));
    }
    public function accept($booking_id){
        $booking = Booking::findOrFail($booking_id);
        return view('rides.show', compact('booking'));
    }
    public function store(Request $request){
        $user = Auth::user();
        if(Gate::check('isRider')){
            $validated = $request->validate([
                'departure_time' => ['required', 'date'],
                'booking_id' => ['required', 'integer']
            ]);
            $booking = Booking::findOrFail($validated['booking_id']);
    
            $ride = new Ride([
                'rider_id' => $user->id,
                'departure_time' => $validated['departure_time']
            ]);
            
            $ride->booking()->associate($booking);
            $ride->save();
            session()->flash('ride_success', 'You created a ride');

            return redirect()->route('home');
        }else{
            abort(403);
        }
        
    }

    public function view($ride_id){
        if(!Gate::check('isRider')){
            abort(403);
        }

        $ride = Ride::with('booking')->findOrFail($ride_id);

        return view('rides.update', compact('ride'));
    }
    public function update(Request $request){
        if(!Gate::allows('isRider')){
            abort(403);
        }

        $validated = $request->validate([
            'departure_time' => ['date', 'required'],
            'ride_id' => ['required', 'integer']
        ]);
        $ride = Ride::findorFail($validated['ride_id']);
        $ride->update([
            'completed' => true
        ]);
        session()->flash('ride_completed', 'You Marked this ride as completed');
        return redirect()->route('home');

    }

    public function complete(Request $request){
        $validated = $request->validate([
            'ride_id' => ['required', 'integer']
        ]);

        $ride = Ride::findOrFail($validated['ride_id']);
        $ride->update([
            'completed' => true
        ]);

        session()->flash('ride_completed', 'You marked this ride as completed');
        return redirect()->back();
    }
}
