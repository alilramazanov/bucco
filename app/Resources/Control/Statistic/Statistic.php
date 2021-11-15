<?php

namespace App\Resources\Control\Statistic;

use App\Models\Task;

class Statistic
{


    // статистика задач в процентах
    public function getStatistic($allTasks, $currentTasks, $completedTasks, $overdueTasks ){

        return $arrStatistic = [
                'current' => round(($currentTasks != 0 ? ($currentTasks / $allTasks) : 0) * 100, 0),
                'completed' => round(($completedTasks != 0 ? ($completedTasks  / $allTasks) : 0) * 100, 0),
                'overdue' => round(($overdueTasks != 0 ? ($overdueTasks / $allTasks) : 0) * 100, 0)
            ];


    }



    // Статистика группы в процентах выполненных задач
    public function getGroupStatistic($group_id){

        $allGroupTasks = Task::query()
            ->where('group_id', $group_id )
            ->get();

        $allGroupTasksCount = $allGroupTasks
            ->where('group_id', $group_id )
            ->count();

        $currentGroupTasks = $allGroupTasks
            ->where('group_id',$group_id)
            ->where('task_status_id', 1)
            ->count();

        $completedGroupTasks = $allGroupTasks
            ->where('group_id', $group_id)
            ->where('task_status_id', 2)
            ->count();

        $overdueGroupTasks = $allGroupTasks
            ->where('group_id', $group_id)
            ->where('task_status_id', 3)
            ->count();



        return $this->getStatistic($allGroupTasksCount, $currentGroupTasks, $completedGroupTasks, $overdueGroupTasks );

    }



    // Статистика участника группы в процентах
    public function getGroupMemberStatistic($member_id, $group_id){

        $allMemberTasks = Task::query()
            ->where('member_id', $member_id)
            ->where('group_id', $group_id);

        $allMemberTasksCount = $allMemberTasks
            ->where('member_id', $member_id)
            ->where('group_id', $group_id)
            ->count();


        $currentMemberTasks = Task::query()
            ->where('member_id', $member_id)
            ->where('group_id', $group_id)
            ->where('task_status_id', 1)
            ->count();

        $completedMemberTasks = $allMemberTasks
            ->where('member_id', $member_id)
            ->where('group_id', $group_id)
            ->where('task_status_id', 2)
            ->count();

        $overdueMemberTasks = $allMemberTasks
            ->where('member_id', $member_id)
            ->where('group_id', $group_id)
            ->where('task_status_id', 3)
            ->count();


        return $this->getStatistic($allMemberTasksCount, $currentMemberTasks, $completedMemberTasks, $overdueMemberTasks);

    }

}
