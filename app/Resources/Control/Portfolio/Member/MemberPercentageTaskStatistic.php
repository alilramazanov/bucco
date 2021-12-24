<?php

namespace App\Resources\Control\Portfolio\Member;

use App\Models\Task;
use App\Resources\Control\Portfolio\PercentageTaskStatistic;

class MemberPercentageTaskStatistic extends PercentageTaskStatistic
{

    public function loadTask()
    {
        $tasks= Task::query()
            ->where('member_id', $this->fields['member_id'])
            ->where('group_id', $this->fields['group_id']);

        return $tasks;
    }
}
