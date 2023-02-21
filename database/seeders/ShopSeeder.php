<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('shops')->insert([
            [
                'owner_id' => 1,
                'name' => '店名',
                'information' => '店情報',
                'filename' => 'sample1.jpg',
                'is_selling' => true,
            ],
            [
                'owner_id' => 2,
                'name' => '店名',
                'information' => '店情報',
                'filename' => 'sample2.jpg',
                'is_selling' => true,
            ],
            [
                'owner_id' => 3,
                'name' => '店名',
                'information' => '店情報',
                'filename' => 'sample3.jpg',
                'is_selling' => true,
            ],
        ]);
    }
}
