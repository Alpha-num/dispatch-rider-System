<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    use HasFactory;
    protected $fillable = [
        'rider_id',
        'departure_time',
        'completed'
    ];

    public function booking(){
        return $this->belongsTo(Booking::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function ratings(){
        return $this->belongsTo(Ride::class);
    }

}
