<?php

namespace Database\Seeders;

use App\Models\TaskTemplate;
use Illuminate\Database\Seeder;
use Database\Factories\TaskTemplateFactory;


class TaskTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 1; $i <= 100; $i++){
            $templates = 'задача '.rand(1, 20);
            $group_id = rand(1,3);

            $taskTemplate = [
                'group_id' => $group_id,
                'name' => $templates
            ];

            \DB::table('task_templates')->insert($taskTemplate);

        }


    }
}
