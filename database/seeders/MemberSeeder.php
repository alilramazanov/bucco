<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        for ($i = 1; $i <= 100; $i++){
            $members = [
                'user_id' => $i,
                'admin_id' => rand(1,2)
            ];
            DB::table('members')->insert($members);
        }
    }
}
