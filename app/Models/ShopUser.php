<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class ShopUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'shop_level',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

