<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Seeder;

class ReservationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => 1,
            'shop_id' => 2,
            'start_at' => '2023-4-1 17:00',
            'num_of_users' => 1,
        ];
        Reservation::create($param);
        $param = [
            'user_id' => 1,
            'shop_id' => 3,
            'start_at' => '2023-4-5 17:00',
            'num_of_users' => 2,
        ];
        Reservation::create($param);
        $param = [
            'user_id' => 1,
            'shop_id' => 4,
            'start_at' => '2024-6-1 17:00',
            'num_of_users' => 3,
        ];
        Reservation::create($param);
    }
}
