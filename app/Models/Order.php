<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'merchant_id',
        'total_price',
        'status',
        'delivery_address_id',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    // Relationships
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

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function robotMovements()
    {
        return $this->hasMany(RobotMovement::class);
    }
}
