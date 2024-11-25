<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Robot extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['status', 'latitude', 'longitude'];

    protected $casts = [
        'latitude' => 'double',
        'longitude' => 'double',
    ];

    // Relationships
    public function movements()
    {
        return $this->hasMany(RobotMovement::class);
    }

    // Query Scopes
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    // Methods
    public function assignToOrder(Order $order): bool
    {
        if ($this->status === 'available') {
            $this->status = 'busy';
            $this->save();

            RobotMovement::create([
                'robot_id' => $this->id,
                'order_id' => $order->id,
                'current_location' => "{$this->latitude},{$this->longitude}",
                'next_location' => "{$order->merchant->latitude},{$order->merchant->longitude}",
            ]);

            return true;
        }
        return false;
    }
}
