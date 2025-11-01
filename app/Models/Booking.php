<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Booking extends Model
{
    protected $table = 'bookings';

    protected $fillable = ['user_id','ticket_id','quantity','status'];

    protected $casts = [
        'id'        => 'integer',
        'user_id'   => 'integer',
        'ticket_id' => 'integer',
        'quantity'  => 'integer',
        'status'    => 'string',
    ];

    public function user() : BelongsTo 
    { 
        return $this->belongsTo(User::class, 'user_id', 'id'); 
    }
    public function ticket() : BelongsTo 
    { 
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id'); 
    }
    public function payment() : HasOne 
    { 
        return $this->hasOne(Payment::class, 'booking_id', 'id'); 
    }
}
