<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['admin', 'merchant', 'customer'];
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        foreach ($roles as $roleName) {
            $email = "{$roleName}@robodeliver.site";

            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => ucfirst($roleName),
                    'email' => $email,
                    'password' => Hash::make('Admin#1234'),
                ]
            );

            $user->assignRole($roleName);
        }

        $this->command->info('Roles and users have been seeded successfully!');
    }
}
