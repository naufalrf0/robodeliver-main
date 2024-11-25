<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryAddress extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'label',
        'street',
        'city',
        'province',
        'postal_code',
        'latitude',
        'longitude',
        'is_default',
    ];

    protected $casts = [
        'latitude' => 'double',
        'longitude' => 'double',
        'is_default' => 'boolean',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
