<?php

namespace Database\Seeders;

use App\Models\ShopUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ShopUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'test-shop',
            'email' => 'test.shop@example.com',
            'password' => Hash::make('test-shop-001'),
            'shop_level' => 1,
        ];
        ShopUser::create($param);
        $param = [
            'name' => 'test-shop-2',
            'email' => 'test.shop2@example.com',
            'password' => Hash::make('test-shop-002'),
            'shop_level' => 0,
        ];
        ShopUser::create($param);
    }
}
