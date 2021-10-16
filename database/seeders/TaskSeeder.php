<?php

namespace Database\Seeders;

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

        for ($i = 1; $i < 10000 ; $i++){
            $task = [
                'task_template_id' => rand(1, 100),
                'task_status_id' => rand(1, 3),
                'group_id' => rand(1, 3),
                'member_id' => rand(1, 100)
            ];

            \DB::table('tasks')->insert($task);
        }
    }
}
