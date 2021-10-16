<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'Магомед(админимтратор)',
            'login' => 'Magomed',
            'password' => '123456'

        ]);
        DB::table('admins')->insert([
            'name' => 'Ангелина(администратор)',
            'login' => 'Angelina',
            'password' => '123456'
        ]);
        //
    }
}
