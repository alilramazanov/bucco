<?php

namespace App\Resources\Control\Portfolio;

use App\Models\Task;

abstract class TaskStatistic extends TaskStatisticCore implements iStatistic
{

    // Возвращает массив с задачами. Прежде чем вызвать, необъодимо инициализировать поля с помощью makeStatistic
    public function getStatistic()
    {
        $statistic = [
            'all' => $this->allTasks,
            'completed' => $this->completedTasks,
            'overdue' => $this->overdueTasks,
        ];

        return $statistic;
    }
}
