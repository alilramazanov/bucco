<?php

namespace App\Resources\Control\Statistic\Group;

use App\Models\Task;
use App\Resources\Control\Statistic\StatisticCore;

class GroupStatistic extends StatisticCore
{







    public function getGroupStatistic($group_id){

        $allGroupTasks = Task::query()
            ->where('group_id', $group_id )
            ->get();

        $allGroupTasksCount = $allGroupTasks
            ->where('group_id', $group_id )
            ->count();

        $currentGroupTasks = $allGroupTasks
            ->where('group_id',$group_id)
            ->whereIn('task_status_id', [1,2])
            ->count();

        $completedGroupTasks = $allGroupTasks
            ->where('group_id', $group_id)
            ->where('task_status_id', 3)
            ->count();

        $overdueGroupTasks = $allGroupTasks
            ->where('group_id', $group_id)
            ->where('task_status_id', 4)
            ->count();



        return $this->getStatistic($allGroupTasksCount, $currentGroupTasks, $completedGroupTasks, $overdueGroupTasks );

    }


}
