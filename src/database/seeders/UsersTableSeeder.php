<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'てすと太郎',
            'email' => 'testtesttest@example.com',
            'password' => Hash::make('123123123'),
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'てすと花子',
            'email' => 'testtesttest2@example.com',
            'password' => Hash::make('123123123'),
        ];
        DB::table('users')->insert($param);    }
}
