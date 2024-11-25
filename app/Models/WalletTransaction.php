<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_wallet_id',
        'transaction_type',
        'amount',
        'transaction_status',
        'reference',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    // Relationships
    public function wallet()
    {
        return $this->belongsTo(UserWallet::class, 'user_wallet_id');
    }
}
