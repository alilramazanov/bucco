<?php

namespace App\Resources\Control\Portfolio\Member;

use App\Models\Task;
use App\Resources\Control\Portfolio\TaskStatistic;

class AdminMemberTasksStatistic extends TaskStatistic
{

    public function loadTask()
    {
        $tasks = Task::query()
            ->where('member_id', $this->fields['member_id'])
            ->where('admin_id', $this->fields['admin_id'])
            ->get();

        return $tasks;
    }
}
