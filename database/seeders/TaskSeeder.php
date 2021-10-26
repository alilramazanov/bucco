<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i = 1; $i < 100 ; $i++){
            $description =  $faker->realText(rand(1000, 10000));

            $task = [
                'task_template_id' => rand(1, 20),
                'task_status_id' => rand(1, 3),
                'description' => $description,
                'group_id' => rand(1, 2),
                'member_id' => rand(1, 10),
                'admin_id' => rand(1,3)
            ];

            \DB::table('tasks')->insert($task);
        }
    }
}
