<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RobotMovement extends Model
{
    use HasFactory;

    protected $fillable = [
        'robot_id',
        'order_id',
        'current_location',
        'next_location',
        'movement_status',
        'estimated_arrival'
    ];

    public function robot()
    {
        return $this->belongsTo(Robot::class);
    }

    public function order()
    {
        return $this->belongsTo(UserOrder::class);
    }
}
