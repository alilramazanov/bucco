<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        for ($i =1; $i<=100; $i++){
            $users = [
                'login' => Str::slug('пользователь'.$i),
                'password' => '123456'

            ];
            DB::table('users')->insert($users);

        }

    }
}
