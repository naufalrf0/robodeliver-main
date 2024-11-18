<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'merchant_id',
        'delivery_address_id',
        'total_price',
        'order_status',
        'payment_status',
        'is_unlocked'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function deliveryAddress()
    {
        return $this->belongsTo(DeliveryAddress::class);
    }
}
