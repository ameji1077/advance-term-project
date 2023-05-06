<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'reservation_id' => 1,
            'user_id' => 1,
            'shop_id' => 1,
            'stars' => 3,
            'comment' => 'レビューです。レビューです。レビューです。レビューです。'
        ];
        Review::create($param);
    }
}
