<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    protected $table = 'tickets';

    protected $fillable = ['type','price','quantity','event_id'];

    protected $casts = [
        'id' => 'integer',
        'type' => 'string',
        'price' => 'decimal:6',
        'quantity' => 'integer',
        'event_id' => 'integer',
    ];

    public function event() : BelongsTo 
    { 
        return $this->belongsTo(Event::class, 'event_id', 'id'); 
    }

    public function bookings() : HasMany
    { 
        return $this->hasMany(Booking::class, 'ticket_id', 'id'); 
    }
}
