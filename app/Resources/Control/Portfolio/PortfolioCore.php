<?php

namespace App\Resources\Control\Portfolio;

abstract class PortfolioCore
{
    // Общая функция получения портфолио из задач
    public  function getPortfolio($tasks){

        $completedTasks = $tasks
            ->where('task_status_id', 3)
            ->count();

        $overdueTasks = $tasks
            ->where('task_status_id', 4)
            ->count();

        $inProgressTasks = $tasks
            ->where('task_status_id', 2)
            ->count();

        $onQueueTasks = $tasks
            ->where('task_status_id', 1)
            ->count();

        $allTasks = $completedTasks + $overdueTasks + $onQueueTasks + $inProgressTasks;

        return [
            'all' => $allTasks,
            'completed' => $completedTasks,
            'overdue' => $overdueTasks,

        ];

    }

}
