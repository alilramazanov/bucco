<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GroupMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 1; $i <= 100; $i++) {
            $position = [
                'group_id' => rand(1, 3),
                'member_id' => rand(1, 100),
                'position_template_id' => rand(1, 18)
            ];
            \DB::table('group_members')->insert($position);

        }
    }
}
