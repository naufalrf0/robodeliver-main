<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    // Fillable fields
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'avatar',
    ];

    // Hidden fields
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casting fields
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relationships
    public function userInfo()
    {
        return $this->hasOne(UserInfo::class);
    }

    public function wallet()
    {
        return $this->hasOne(UserWallet::class);
    }

    public function walletTransactions()
    {
        return $this->hasManyThrough(WalletTransaction::class, UserWallet::class);
    }

    public function deliveryAddresses()
    {
        return $this->hasMany(DeliveryAddress::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function notifications()
    {
        return $this->morphMany(\Illuminate\Notifications\DatabaseNotification::class, 'notifiable');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    // Query Scopes
    public function scopeWithEmail($query, string $email)
    {
        return $query->where('email', $email);
    }

    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }

    public function scopeWithOrders($query)
    {
        return $query->whereHas('orders');
    }

    public function getFormattedBalanceAttribute()
    {
        return 'Rp' . number_format($this->wallet->balance ?? 0, 0, ',', '.');
    }

    // Helper Methods
    public function hasRoleName(string $role): bool
    {
        return $this->hasRole($role);
    }

    public function getAvatarUrlAttribute()
    {
        return $this->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($this->name);
    }

    public function isVerified(): bool
    {
        return $this->email_verified_at !== null;
    }

    public function addToWishlist(int $productId): Wishlist
    {
        return $this->wishlists()->create(['merchant_product_id' => $productId]);
    }

    // Validation rules
    public static function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'nullable|string|min:6',
        ];
    }

    public static function dynamicRules($id = null)
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => $id ? 'nullable|string|min:6' : 'required|string|min:6',
        ];
    }

    public function merchant()
    {
        return $this->hasOne(Merchant::class);
    }

    // Events
    protected static function booted()
    {
        static::created(function ($user) {
            if (!$user->hasVerifiedEmail()) {
                $user->sendEmailVerificationNotification();
            }

            $user->wallet()->create(['balance' => 0.00]);
        });
    }
}
