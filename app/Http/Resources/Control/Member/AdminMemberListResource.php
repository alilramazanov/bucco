<?php

namespace App\Http\Resources\Control\Member;

use App\Resources\Control\Portfolio\Member\AdminMemberTasksStatistic;
use App\Resources\Control\Rating\Task\TaskRating;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminMemberListResource extends JsonResource
{

    public function toArray($request)
    {

        $taskStatistic = new AdminMemberTasksStatistic();
        $taskStatistic->setFields(['admin_id' => $this->admin_id, 'member_id' => $this->id]);
        $taskStatistic->makeStatistic();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'rating' => TaskRating::getRating($taskStatistic ),
            'portfolio' => $taskStatistic->getStatistic()
        ];
    }

}
