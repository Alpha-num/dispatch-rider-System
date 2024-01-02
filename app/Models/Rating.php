<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'rider_id',
        'rating',
        'comment'
    ];
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function rider(){
        return $this->hasMany(Ride::class, 'rider_id');
    }

    
}
