<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $table = 'payments';
    
    protected $fillable = ['booking_id','user_id','amount','status'];

    protected $casts = [
        'id'             => 'integer',
        'booking_id'     => 'integer',
        'user_id'        => 'integer',
        'amount'         => 'decimal:6',
        'status'         => 'string',
    ];

    public function booking() : BelongsTo
    { 
        return $this->belongsTo(Booking::class, 'booking_id', 'id'); 
    }
}
