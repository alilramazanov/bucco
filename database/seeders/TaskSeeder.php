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

        for ($i = 1; $i < 3000 ; $i++){
            $task = [
                'task_template_id' => rand(1, 100),
                'task_status_id' => rand(1, 3),
                'description' => $faker->realText(rand(100, 1000)),
                'group_id' => rand(1, 3),
                'member_id' => rand(1, 100)
            ];

            \DB::table('tasks')->insert($task);
        }
    }
}
