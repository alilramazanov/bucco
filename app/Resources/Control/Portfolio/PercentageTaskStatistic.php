<?php

namespace App\Resources\Control\Portfolio;

abstract class PercentageTaskStatistic extends TaskStatisticCore implements iStatistic
{

    public function getStatistic( ){

        $statistic = [
            'current' => round(($this->inProgressTasks != 0 ? ($this->inProgressTasks / $this->allTasks) : 0) * 100, 0),
            'completed' => round(($this->completedTasks != 0 ? ($this->completedTasks  / $this->allTasks) : 0) * 100, 0),
            'overdue' => round(($this->overdueTasks != 0 ? ($this->overdueTasks / $this->allTasks) : 0) * 100, 0)
        ];

        return $statistic;

    }
}
