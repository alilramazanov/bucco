<?php

namespace App\Resources\Control\Portfolio;

abstract class TaskStatisticCore
{
    protected $allTasks, $inProgressTasks, $completedTasks, $overdueTasks, $onQueueTasks;
    protected $fields;

    // Добавление полей для фильтрации задач. Каждый наследник добавляет свои поля
    public function setFields(array $fields){
        $this->fields = $fields;
    }

    // Метод для реализации наследником который по своему создаст запрос и вернет свои задачи.
    // Прежде чем вызвать нужно добавить поля который будут использованы с  помощью setFields()
    public abstract function loadTask();

    // Инициализирует поля статистики задачи, и считает задачи из базы
    public function makeStatistic()
    {
        $tasks = $this->loadTask();

        $this->overdueTasks = $tasks
            ->where('task_status_id', 4)
            ->count();

        $this->completedTasks = $tasks
            ->where('task_status_id', 3)
            ->count();

        $this->inProgressTasks = $tasks
            ->where('task_status_id', 2)
            ->count();

        $this->onQueueTasks = $tasks
            ->where('task_status_id', 1)
            ->count();

        $this->allTasks = $this->completedTasks + $this->overdueTasks + $this->onQueueTasks + $this->inProgressTasks;
        $this->inProgressTasks = $this->inProgressTasks + $this->onQueueTasks;
    }

}
