<?php

namespace App\Http\Resources\Control\Member;

use App\Resources\Control\Portfolio\Member\GroupMemberTasksStatistic;
use App\Resources\Control\Rating\Task\TaskRating;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupMemberListResource extends JsonResource
{

    public function toArray($request)
    {
        $groupMemberTaskStatistic = (new GroupMemberTasksStatistic());
        $groupMemberTaskStatistic->setFields(['member_id' => $this->id, 'group_id' => $this->group_id]);
        $groupMemberTaskStatistic->makeStatistic();

        $query = http_build_query(
            array(
                'path' => $this->avatar,
            )
        );

        $avatar = $this->avatar ? \Illuminate\Support\Facades\URL::to('image' . '?' . $query) : null;

        return [
            'id' => $this->id,
            'groupId' => $this->group_id,
            'name' => $this->name,
            'avatar' => $avatar,
            'position' => $this->position,
            'rating' => TaskRating::getRating($groupMemberTaskStatistic),
            'portfolio' => $groupMemberTaskStatistic->getStatistic()
        ];
    }

}
