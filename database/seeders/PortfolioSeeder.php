<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $faker = Factory::create();

        for ($i = 1; $i <= 20; $i++){
            $name = $faker->title();
            $completed_task = rand(1, 40);
            $overdue_task = rand(1, 40);
            $allTask = $completed_task + $overdue_task;
            $portfolio = [
                'member_id' => $i,
                'task_completed' => $completed_task,
                'task_overdue' => $overdue_task,
                'task_all' => $allTask

            ];
            DB::table('portfolio')->insert($portfolio);

        }
    }
}
