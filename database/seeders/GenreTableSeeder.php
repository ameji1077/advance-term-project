<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            '寿司',
            '焼肉',
            '居酒屋',
            'イタリアン',
            'ラーメン',
        ];
        foreach ($names as $name) {
            Genre::create(['name' => $name]);
        }
    }
}
