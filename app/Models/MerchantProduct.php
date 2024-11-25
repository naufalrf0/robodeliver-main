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
        'name',
        'price',
        'description',
        'category_id',
        'image_url',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    // Relationships
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
