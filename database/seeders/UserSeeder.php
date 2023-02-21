<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'ユーザー',
            'email' => 'test@test.com',
            'password' => Hash::make('password123'),
            'created_at' => '2023/01/31 11:11:11',
        ]);
    }
}
