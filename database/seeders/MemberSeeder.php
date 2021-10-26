<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $faker = Factory::create();

        for ($i = 1; $i <= 10; $i++){
            $name = $faker->firstName();


            $members = [
                'admin_id' => rand(1,3),
                'name' => $name,
                'password' => '12345'.$i,
                'login' => Str::slug($name).$i
            ];
            DB::table('members')->insert($members);
        }
    }
}
