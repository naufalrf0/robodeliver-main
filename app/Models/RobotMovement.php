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
        'arrival_time',
        'actual_arrival_time',
        'movement_status',
        'path_history',
    ];

    protected $casts = [
        'arrival_time' => 'datetime',
        'actual_arrival_time' => 'datetime',
        'path_history' => 'array',
    ];

    // Relationships
    public function robot()
    {
        return $this->belongsTo(Robot::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Methods
    public function updateMovement(string $current, string $next): void
    {
        $this->current_location = $current;
        $this->next_location = $next;
        $this->save();
    }

    public function markAsArrived(): void
    {
        $this->movement_status = 'arrived';
        $this->actual_arrival_time = now();
        $this->save();
    }
}
