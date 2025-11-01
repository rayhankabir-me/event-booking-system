<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enum\UserRoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = ['deleted_at'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function events() : HasMany
    { 
        return $this->hasMany(Event::class, 'created_by', 'id'); 
    }

    public function bookings() : HasMany
    {
        return $this->hasMany(Booking::class, 'user_id', 'id');
    }
    
    public function payments() : HasMany
    {
        return $this->hasMany(Payment::class, 'user_id', 'id');
    }


    public function isAdmin() 
    {
        return $this->role === UserRoleEnum::ADMIN; 
    }
    public function isOrganizer() 
    { 
        return $this->role === UserRoleEnum::ORGANIZER; 
    }
    public function isCustomer() 
    { 
        return $this->role === UserRoleEnum::CUSTOMER; 
    }
}
