<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Merchant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'latitude',
        'longitude',
        'image_url',
        'description',
        'status',
        'rating',
    ];

    protected $casts = [
        'latitude' => 'double',
        'longitude' => 'double',
        'rating' => 'float',
    ];

    // Relationships
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function products()
    {
        return $this->hasMany(MerchantProduct::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orders()
    {
        return $this->hasManyThrough(
            Order::class,       
            MerchantProduct::class, 
            'merchant_id',  
            'product_id',   
            'id',         
            'id'                
        );
    }
}
