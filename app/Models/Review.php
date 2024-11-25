<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'merchant_id', 'rating', 'comment'];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    // Query Scopes
    public function scopeByMerchant($query, int $merchantId)
    {
        return $query->where('merchant_id', $merchantId);
    }

    public function scopeByUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }
}
