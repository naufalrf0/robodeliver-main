<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleAndUserSeeder extends Seeder
{
    public function run()
    {
        $roles = ['admin', 'merchant', 'customer'];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        $admin = User::create([
            'name' => 'Admin Robodeliver',
            'email' => 'admin@robodeliver.site',
            'password' => Hash::make('Admin#1234'),
        ]);
        $admin->assignRole('admin');

        $merchant = User::create([
            'name' => 'Merchant Robodeliver',
            'email' => 'merchant@robodeliver.site',
            'password' => Hash::make('Merchant#1234'),
        ]);
        $merchant->assignRole('merchant');

        $customer = User::create([
            'name' => 'Customer Robodeliver',
            'email' => 'customer@robodeliver.site',
            'password' => Hash::make('Customer#1234'),
        ]);
        $customer->assignRole('customer');
    }
}
