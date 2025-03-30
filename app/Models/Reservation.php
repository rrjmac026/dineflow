<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'time',
        'guests',
        'contact_number',
        'special_requests',
        'status',
        'table_number'
    ];

    // Cast date and time fields
    protected $casts = [
        'date' => 'date',
        'time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
