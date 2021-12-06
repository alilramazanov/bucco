<?php

namespace App\Resources\Control\Statistic;

abstract class StatisticCore
{





    public function getStatistic($allTasks, $currentTasks, $completedTasks, $overdueTasks ){

        return $arrStatistic = [
            'current' => round(($currentTasks != 0 ? ($currentTasks / $allTasks) : 0) * 100, 0),
            'completed' => round(($completedTasks != 0 ? ($completedTasks  / $allTasks) : 0) * 100, 0),
            'overdue' => round(($overdueTasks != 0 ? ($overdueTasks / $allTasks) : 0) * 100, 0)
        ];


    }


}
