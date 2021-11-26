<?php

namespace App\Resources\Control\Portfolio\Member;

use App\Models\Task;
use App\Resources\Control\Portfolio\PortfolioCore as Portfolio;

class MemberPortfolio extends Portfolio
{

    //Портфолио участника группы
    public function getGroupMemberPortfolio($member_id, $group_id){

        $tasks = Task::query()
            ->where('member_id', $member_id)
            ->where('group_id', $group_id)
            ->get();

        return $this->getPortfolio($tasks);

    }

    //Портфолио участника админа
    public function getAdminMemberPortfolio($member_id, $admin_id){

        $tasks = Task::query()
            ->where('member_id', $member_id)
            ->where('admin_id', $admin_id)
            ->get();

        return $this->getPortfolio($tasks);
    }

}
