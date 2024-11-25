<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'merchant_product_id',
        'quantity',
        'price',
        'subtotal',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    // Relationships
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(MerchantProduct::class, 'merchant_product_id');
    }

    // Query Scopes
    public function scopeByOrder($query, int $orderId)
    {
        return $query->where('order_id', $orderId);
    }

    // Helper methods
    public function calculateSubtotal()
    {
        $this->subtotal = $this->quantity * $this->price;
        $this->save();
    }
}
