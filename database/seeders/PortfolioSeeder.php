<?php

namespace Database\Seeders;

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

        for ($i = 1; $i <= 100; $i++){
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
