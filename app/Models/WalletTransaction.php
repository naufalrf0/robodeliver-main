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
        'reference'
    ];

    public function wallet()
    {
        return $this->belongsTo(UserWallet::class);
    }
}
