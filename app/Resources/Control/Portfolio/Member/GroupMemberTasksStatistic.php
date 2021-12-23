<?php

namespace App\Resources\Control\Portfolio\Member;

use App\Models\Task;
use App\Resources\Control\Portfolio\TaskStatistic;

class GroupMemberTasksStatistic extends TaskStatistic
{

    public function loadTask()
    {
        $tasks = Task::query()
            ->where('member_id', $this->fields['member_id'])
            ->where('group_id', $this->fields['group_id'])
            ->get();

        return $tasks;
    }
}
