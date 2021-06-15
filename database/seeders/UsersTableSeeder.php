<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('users')->insert([
            'name' => '検証ユーザー',
            'email' => 'test@gmail.com',
            'login_id' => '1',
            'password' => bcrypt('password'),
        ]);
    }
}
