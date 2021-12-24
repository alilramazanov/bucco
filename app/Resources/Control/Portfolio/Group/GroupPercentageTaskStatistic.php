<?php

namespace App\Resources\Control\Portfolio\Group;

use App\Models\Task;
use App\Resources\Control\Portfolio\PercentageTaskStatistic;

class GroupPercentageTaskStatistic extends PercentageTaskStatistic
{

    public function loadTask()
    {
        $tasks = Task::query()
            ->where('group_id', $this->fields['group_id'] )
            ->get();

        return $tasks;
    }
}
