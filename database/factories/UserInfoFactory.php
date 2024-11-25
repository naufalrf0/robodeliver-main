<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserInfoFactory extends Factory
{
    public function definition()
    {
        return [
            'phone_number' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'latitude' => $this->faker->latitude(-6.5, -6.1), 
            'longitude' => $this->faker->longitude(106.7, 107.0),
        ];
    }
}
