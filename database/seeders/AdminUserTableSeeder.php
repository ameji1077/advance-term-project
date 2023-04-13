<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'test-admin',
            'email' => 'test.admin@example.com',
            'password' => Hash::make('test-admin-001'),
            'admin_level' => 1,
        ];
        AdminUser::create($param);
        $param = [
            'name' => 'test-admin-2',
            'email' => 'test.admin2@example.com',
            'password' => Hash::make('test-admin-002'),
            'admin_level' => 0,
        ];
        AdminUser::create($param);
    }
}
