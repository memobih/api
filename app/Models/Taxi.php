<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taxi extends Model
{
    use HasFactory;
    protected $table = 'taxi';
    protected $fillable = [
        'Booking_id',
        'name',
        'phoneNumber',
        'passengers',
        'startDestination',
        'endDestination',
        'date',
        'time',
        'user_id',
    ];
}
