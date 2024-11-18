<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes, HasRoles;

    protected $fillable = [
        'google_id',
        'avatar',
        'name',
        'email',
        'password',
        'email_verified_at',
    ];

    protected $hidden = ['password', 'remember_token']; // Tambahkan remember_token jika diperlukan

    // Relasi ke model lain
    public function wallet()
    {
        return $this->hasOne(UserWallet::class);
    }

    public function userInfo()
    {
        return $this->hasOne(UserInfo::class);
    }

    public function orders()
    {
        return $this->hasMany(UserOrder::class);
    }

    public function carts()
    {
        return $this->hasMany(UserCart::class);
    }

    public function deliveryAddresses()
    {
        return $this->hasMany(DeliveryAddress::class);
    }

    public function ratings()
    {
        return $this->hasMany(ProductRating::class);
    }

    public function merchants()
    {
        return $this->hasOne(Merchant::class);
    }

    public function routeNotificationForMail($notification)
    {
        return $this->email;
    }
}
