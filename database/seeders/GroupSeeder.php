<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Factory::create();

        for ($i =0; $i < 3; $i++){

            $name = $faker->company();

            $table = [
                'name' => $name,
                'admin_id'=> rand(1, 3)
            ];
            DB::table('groups')->insert($table);

        }

    }
}
