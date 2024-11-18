<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Robot extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'latitude',
        'longitude'
    ];

    public function movements()
    {
        return $this->hasMany(RobotMovement::class);
    }
}
