<?php

namespace App\Resources\Control\Portfolio;

abstract class PortfolioCore
{
    // Общая функция получения портфолио из задач
    public  function getPortfolio($tasks){

        $completedTasks = $tasks
            ->where('task_status_id', 2)
            ->count();

        $overdueTasks = $tasks
            ->where('task_status_id', 3)
            ->count();

        $currentTask = $tasks
            ->where('task_status_id', 4)
            ->count();

        $inProgressTask = $tasks
            ->where('task_status_id', 1)
            ->count();

        $allTasks = $completedTasks + $overdueTasks + $currentTask + $inProgressTask;

        return [
            'all' => $allTasks,
            'completed' => $completedTasks,
            'overdue' => $overdueTasks
        ];

    }

}
