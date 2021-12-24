<?php

namespace App\Resources\Control\Portfolio;

abstract class PercentageTaskStatistic implements iStatistic
{


    protected $allTasks, $currentTasks, $completedTasks, $overdueTasks;
    protected $fields;

    public function setFields(array $fields){
        $this->fields = $fields;
    }

    public abstract function loadTask();

    public function makeStatistic(){
        $tasks = $this->loadTask();

        $this->allTasks = $tasks
            ->count();

        $this->currentTasks = $tasks
            ->whereIn('task_status_id', [1,2])
            ->count();

        $this->completedTasks = $tasks
            ->where('task_status_id', 3)
            ->count();

        $this->overdueTasks = $tasks
            ->where('task_status_id', 4)
            ->count();

    }

    public function getStatistic( ){

        return $arrStatistic = [
            'current' => round(($this->currentTasks != 0 ? ($this->currentTasks / $this->allTasks) : 0) * 100, 0),
            'completed' => round(($this->completedTasks != 0 ? ($this->completedTasks  / $this->allTasks) : 0) * 100, 0),
            'overdue' => round(($this->overdueTasks != 0 ? ($this->overdueTasks / $this->allTasks) : 0) * 100, 0)
        ];

    }
}
