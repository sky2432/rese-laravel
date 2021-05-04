<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('genres')->insert([
            [   //1
                'name' => '寿司',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [   //2
                'name' => '焼肉',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [   //3
                'name' => '居酒屋',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [   //4
                'name' => 'イタリアン',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [   //5
                'name' => 'ラーメン',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
