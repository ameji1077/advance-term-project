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
        ];
        User::create($param);
    }
}
