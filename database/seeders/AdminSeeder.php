<?php

namespace Database\Seeders;


use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $faker = Factory::create();


        for ($i = 0; $i < 3; $i++) {

            $name = $faker->name();


            DB::table('admins')->insert([
                'name' => $name,
                'login' => Str::slug($name). ".@gmail.com",
                'password' => '123456'

            ]);
        }
    }
}
