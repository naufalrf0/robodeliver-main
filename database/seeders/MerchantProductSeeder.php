<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Merchant;
use App\Models\MerchantProduct;
use App\Models\Category;

class MerchantProductSeeder extends Seeder
{
    public function run()
    {
        // Pastikan kategori sudah ada
        $categories = [
            'Makanan',
            'Minuman',
            'Snack',
        ];
        foreach ($categories as $categoryName) {
            Category::firstOrCreate(['name' => $categoryName]);
        }

        // Buat Merchant dan Produk
        $merchants = [
            [
                'user_id' => 4, // User pertama
                'name' => 'Mie Gacoan',
                'address' => 'Jl. Raya Dramaga No.1, Bogor',
                'latitude' => -6.588450,
                'longitude' => 106.805500,
                'status' => 'active',
                'rating' => 4.8,
                'products' => [
                    ['name' => 'Mie Angel', 'price' => 20000, 'description' => 'Mie pedas level rendah.', 'category' => 'Makanan'],
                    ['name' => 'Mie Setan', 'price' => 22000, 'description' => 'Mie pedas level tinggi.', 'category' => 'Makanan'],
                    ['name' => 'Es Genderuwo', 'price' => 15000, 'description' => 'Minuman segar dengan topping jelly.', 'category' => 'Minuman'],
                ],
            ],
            [
                'user_id' => 5,
                'name' => 'Mixue',
                'address' => 'Jl. Pajajaran No.3, Bogor',
                'latitude' => -6.590150,
                'longitude' => 106.807000,
                'status' => 'active',
                'rating' => 4.5,
                'products' => [
                    ['name' => 'Es Krim Cone', 'price' => 8000, 'description' => 'Es krim cone vanilla.', 'category' => 'Snack'],
                    ['name' => 'Boba Milk Tea', 'price' => 25000, 'description' => 'Minuman teh susu dengan boba.', 'category' => 'Minuman'],
                    ['name' => 'Ice Cream Sundae', 'price' => 15000, 'description' => 'Es krim sundae dengan topping coklat.', 'category' => 'Snack'],
                ],
            ],
            [
                'user_id' => 6,
                'name' => 'Pecel Lele Arebra',
                'address' => 'Jl. Babakan Raya, Bogor',
                'latitude' => -6.589500,
                'longitude' => 106.806500,
                'status' => 'active',
                'rating' => 4.6,
                'products' => [
                    ['name' => 'Pecel Lele', 'price' => 18000, 'description' => 'Lele goreng dengan sambal khas.', 'category' => 'Makanan'],
                    ['name' => 'Ayam Penyet', 'price' => 20000, 'description' => 'Ayam penyet sambal pedas.', 'category' => 'Makanan'],
                    ['name' => 'Es Teh Manis', 'price' => 5000, 'description' => 'Minuman teh manis dingin.', 'category' => 'Minuman'],
                ],
            ],
            [
                'user_id' => 7,
                'name' => 'Bakso Pak Min',
                'address' => 'Jl. Surya Kencana, Bogor',
                'latitude' => -6.590700,
                'longitude' => 106.808000,
                'status' => 'active',
                'rating' => 4.9,
                'products' => [
                    ['name' => 'Bakso Urat', 'price' => 25000, 'description' => 'Bakso urat jumbo.', 'category' => 'Makanan'],
                    ['name' => 'Bakso Campur', 'price' => 23000, 'description' => 'Bakso campur dengan tahu dan mie.', 'category' => 'Makanan'],
                    ['name' => 'Es Jeruk', 'price' => 10000, 'description' => 'Minuman jeruk segar.', 'category' => 'Minuman'],
                ],
            ],
            [
                'user_id' => 8,
                'name' => 'Kopi Kenangan',
                'address' => 'Jl. Bogor Nirwana, Bogor',
                'latitude' => -6.591000,
                'longitude' => 106.809000,
                'status' => 'active',
                'rating' => 4.7,
                'products' => [
                    ['name' => 'Kopi Kenangan Mantan', 'price' => 20000, 'description' => 'Kopi susu gula aren.', 'category' => 'Minuman'],
                    ['name' => 'Americano', 'price' => 15000, 'description' => 'Kopi hitam tanpa gula.', 'category' => 'Minuman'],
                    ['name' => 'Latte', 'price' => 25000, 'description' => 'Kopi susu latte.', 'category' => 'Minuman'],
                ],
            ],
        ];

        foreach ($merchants as $merchantData) {
            $merchant = Merchant::create([
                'user_id' => $merchantData['user_id'],
                'name' => $merchantData['name'],
                'address' => $merchantData['address'],
                'latitude' => $merchantData['latitude'],
                'longitude' => $merchantData['longitude'],
                'status' => $merchantData['status'],
                'rating' => $merchantData['rating'],
            ]);

            foreach ($merchantData['products'] as $productData) {
                $category = \App\Models\Category::where('name', $productData['category'])->first();
                $merchant->products()->create([
                    'name' => $productData['name'],
                    'price' => $productData['price'],
                    'description' => $productData['description'],
                    'category_id' => $category->id,
                ]);
            }
        }

        $this->command->info('Merchant dan data produk berhasil diisi!');
    }
}
