<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MerchantProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'merchant_id',
        'product_images',
        'product_name',
        'product_price',
        'categories'
    ];

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function ratings()
    {
        return $this->hasMany(ProductRating::class);
    }
}
