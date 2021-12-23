<?php

namespace App\Resources\Control\Portfolio;

use App\Models\Task;

abstract class TaskStatistic implements iStatistic
{

    protected $fields;
    protected $allTasks, $inProgressTasks, $completedTasks, $overdueTasks;


    // Добавление полей для фильтрации задач. Каждый наследник добавляет свои поля
    public function setFields(array $fields){
        $this->fields = $fields;
    }

    // Метод для реализации наследником который по своему создаст запрос и вернет свои задачи.
    // Прежде чем вызвать нужно добавить поля который будут использованы
    public abstract function loadTask();


    // Возвращает массив с задачами. Прежде чем вызвать, необъодимо инициализировать поля с помощью makeStatistic
    public function getStatistic()
    {
        return [
            'all' => $this->allTasks,
            'completed' => $this->completedTasks,
            'overdue' => $this->overdueTasks,

        ];
    }

    // Инициализирует поля статистики задачи, и считает задачи из базы
    public function makeStatistic()
    {
        $tasks = $this->loadTask();

        $this->completedTasks = $tasks
            ->where('task_status_id', 3)
            ->count();

        $this->overdueTasks = $tasks
            ->where('task_status_id', 4)
            ->count();

        $this->inProgressTasks = $tasks
            ->where('task_status_id', 2)
            ->count();

        $onQueueTasks = $tasks
            ->where('task_status_id', 1)
            ->count();

        $this->allTasks = $this->completedTasks + $this->overdueTasks + $onQueueTasks + $this->inProgressTasks;
    }
}
