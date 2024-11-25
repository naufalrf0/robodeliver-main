<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserInfo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'phone_number', 'address', 'latitude', 'longitude'];

    protected $casts = [
        'latitude' => 'double',
        'longitude' => 'double',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Query Scopes
    public function scopeNearby($query, $latitude, $longitude, $radius = 10)
    {
        return $query->whereRaw(
            '(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) < ?',
            [$latitude, $longitude, $latitude, $radius]
        );
    }
}
