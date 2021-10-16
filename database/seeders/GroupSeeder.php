<?php

namespace Database\Seeders;

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
        $groups = [
            'SmartDev',
            'Cron',
            'Группа 05ru'
        ];


        foreach ($groups as $group){
            $table = [
                'name' => $group,
                'admin_id'=> rand(1, 2)
            ];
            DB::table('groups')->insert($table);
        }
    }
}
