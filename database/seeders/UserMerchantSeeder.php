<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserMerchantSeeder extends Seeder
{
    public function run()
    {
        $merchantRole = Role::firstOrCreate(['name' => 'merchant']);

        $users = [
            [
                'name' => 'Mie Gacoan Owner',
                'email' => 'gacoan@robodeliver.site',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Mixue Owner',
                'email' => 'mixue@robodeliver.site',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Pecel Lele Owner',
                'email' => 'pecellele@robodeliver.site',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Bakso Pak Min Owner',
                'email' => 'baksopakmin@robodeliver.site',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Kopi Kenangan Owner',
                'email' => 'kopikenangan@robodeliver.site',
                'password' => bcrypt('password'),
            ],
        ];

        foreach ($users as $userData) {
            $user = User::create($userData);
            $user->assignRole($merchantRole); 
        }

        $this->command->info('Pemilik merchant telah berhasil di-seed!');
    }
}
