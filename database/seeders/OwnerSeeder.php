<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('owners')->insert([
            [
                'name' => 'オーナー1',
                'email' => 'test1@test.com',
                'password' =>  Hash::make('password123'),
                'created_at' => '2023/01/31 11:11:11',
            ],
            [
                'name' => 'オーナー2',
                'email' => 'test2@test.com',
                'password' =>  Hash::make('password123'),
                'created_at' => '2023/01/31 11:11:11',
            ],
            [
                'name' => 'オーナー3',
                'email' => 'test3@test.com',
                'password' =>  Hash::make('password123'),
                'created_at' => '2023/01/31 11:11:11',
            ],
        ]);
    }
}
