<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            '東京都',
            '大阪府',
            '福岡県',
        ];
        foreach ($names as $name) {
            Area::create(['name' => $name]);
        }
    }
}
