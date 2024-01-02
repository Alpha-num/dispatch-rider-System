<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'destination',
        'item_name',
        'item_quantity',
        'completed'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function ride(){
        return $this->hasOne(Ride::class);
    }
    
}
