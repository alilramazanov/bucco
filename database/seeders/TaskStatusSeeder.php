<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'В очереди',
            'Выполняется',
            'Выполненная',
            'Просроченная'
        ];
        foreach ($names as $name){
            $statuses = [
                'name' => $name
            ];
            \DB::table('task_statuses')->insert($statuses);
        }
    }
}
