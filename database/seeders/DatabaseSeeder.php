<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\PositionTemplate;
use App\Models\Task;
use App\Models\TaskTemplate;
use Database\Factories\TaskTemplateFactory;
use http\Client\Curl\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(MemberSeeder::class);
//        $this->call(PassportSeeder::class);
        $this->call(PortfolioSeeder::class);
        $this->call(PositionTemplateSeeder::class);
        $this->call(GroupMemberSeeder::class);
        $this->call(TaskTemplateSeeder::class);
        $this->call(TaskStatusSeeder::class);
        $this->call(TaskSeeder::class);





    }
}
