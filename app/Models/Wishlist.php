<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'merchant_product_id'];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(MerchantProduct::class, 'merchant_product_id');
    }

    // Query Scopes
    public function scopeForUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByProduct($query, int $productId)
    {
        return $query->where('merchant_product_id', $productId);
    }
}
