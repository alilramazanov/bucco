<?php

namespace App\Resources\Control\Portfolio;

use App\Models\Task;

class GroupMemberPortfolio
{


    //Статистика участника группы
    public function getGroupMemberPortfolio($member_id, $group_id){

        $tasks = Task::query()
            ->where('member_id', $member_id)
            ->where('group_id', $group_id)
            ->get();

        $completedTasks = $tasks
            ->where('task_status_id', 2)
            ->count();

        $overdueTasks = $tasks
            ->where('task_status_id', 3)
            ->count();

        $allTasks = $completedTasks + $overdueTasks;

        return [
            'all' => $allTasks,
            'completed' => $completedTasks,
            'overdue' => $overdueTasks
        ];


    }

}
