<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;

class PositionTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $faker = Factory::create();

        for ($i = 0; $i < 100; $i++){
            $name = $faker->streetName();

            \DB::table('position_templates')->insert([
                'group_id' => rand(1,3),
                'name' => $name
            ]);

        }


    }
}
