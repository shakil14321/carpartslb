<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Address;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'phone',
        'user_image',
        'password',
        'role',
        'verification_code',
        'code_expires_at',
        'email_verified_at',
        'remember_token'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'verification_code'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'code_expires_at' => 'datetime',
    ];

    // Helper
    public function isVerified(): bool
    {
        return !is_null($this->email_verified_at);
    }

    public function addresses(){
        return $this->hasMany(Address::class);
    }

    public function defaultAddress(){
        return $this->hasOne(Address::class)->where('is_default', true);
    }
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
