<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'test-user',
            'email' => 'test.user@example.com',
            'password' => Hash::make('test-user-001'),
            'email_verified_at' => '2023-4-23 0:00',
            'user_type' => 1,
        ];
        User::create($param);
        $param = [
            'name' => 'test-shop',
            'email' => 'test.shop@example.com',
            'password' => Hash::make('test-shop-001'),
            'email_verified_at' => '2023-4-23 0:00',
            'user_type' => 5,
        ];
        User::create($param);
        $param = [
            'name' => '店舗作成用',
            'email' => 'test.shop.02@example.com',
            'password' => Hash::make('test-shop-002'),
            'email_verified_at' => '2023-4-23 0:00',
            'user_type' => 5,
        ];
        User::create($param);
        $param = [
            'name' => 'test-admin',
            'email' => 'test.admin@example.com',
            'password' => Hash::make('test-admin-001'),
            'email_verified_at' => '2023-4-23 0:00',
            'user_type' => 10,
        ];
        User::create($param);
    }
}
