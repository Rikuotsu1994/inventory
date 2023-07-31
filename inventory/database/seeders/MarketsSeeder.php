<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarketsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('markets')->insert([
            [
                'name' => 'イオン',
                'users_id' => '1',
            ],
            [
                'name' => 'カルディ',
                'users_id' => '1',
            ],
        ]);
    }
}
