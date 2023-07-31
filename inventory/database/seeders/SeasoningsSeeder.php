<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeasoningsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seasonings')->insert([
            [
                'users_id' => '1',
                'name' => '塩',
            ],
            [
                'users_id' => '1',
                'name' => '砂糖',
            ],
        ]);
    }
}
