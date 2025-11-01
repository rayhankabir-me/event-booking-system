<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $fillable = ['title','description','date','location','created_by'];

    protected $dates = ['date'];

    protected $casts = [
        'id'            => 'integer',
        'title'         => 'string',
        'description'   => 'string',
        'location'      => 'string',
        'created_by'    => 'integer',
        'date'          => 'datetime',
    ];

    //relationships
    public function organizer() : BelongsTo
    { 
        return $this->belongsTo(User::class, 'created_by', 'id'); 
    }

    public function tickets() : HasMany
    { 
        return $this->hasMany(Ticket::class, 'event_id', 'id'); 
    }

}
