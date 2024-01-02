<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Ride;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function index(){
        
        $rider = Auth::user();
        $ratings = Rating::with('user')->where('rider_id', $rider->id)->get();

        return view('rating.index', compact('ratings'));
    }

    public function create($rider_id){
        $user = User::findorFail($rider_id);
        return view('rating.create', compact('user'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'rider_id' => ['required', 'integer'],
            'comment' => ['string', 'max:100', 'required']
        ]);

        $rating = new Rating([
            'rider_id' => $validated['rider_id'],
            'user_id' => Auth::user()->id,
            'comment' => $validated['comment'],
            'rating' => $validated['rating']
        ]);

        $rating->save();
        return redirect()->back()->with('rating_success', 'Rating Saved Successfully');

    }
}
