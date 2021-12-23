<?php

namespace App\Http\Resources\Control\Member;

use App\Models\Member;
use App\Resources\Control\Portfolio\Member\GroupMemberTasksStatistic;
use App\Resources\Control\Portfolio\Member\MemberPortfolio;
use App\Resources\Control\Rating\Member\MemberRating;
use App\Resources\Control\Rating\Task\TaskRating;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Member
 */
class GroupMemberListResource extends JsonResource
{

    public function toArray($request)
    {
//        $groupMemberPortfolio = (new MemberPortfolio())->getGroupMemberPortfolio($this->id, $this->pivot->group_id);
//        $groupMemberRating =  (new MemberRating())->getMemberRating($groupMemberPortfolio);

        $groupMemberTaskStatistic = (new GroupMemberTasksStatistic());
        $groupMemberTaskStatistic->setFields(['member_id' => $this->id, 'group_id' => $this->pivot->group_id]);
        $groupMemberTaskStatistic->makeStatistic();

        $query = http_build_query(
            array(
                'path' => $this->avatar,
            )
        );

        $avatar = $this->avatar ? \Illuminate\Support\Facades\URL::to('image' . '?' . $query) : null;

        return [
            'id' => $this->id,
            'groupId' => $this->pivot->group_id,
            'name' => $this->name,
            'avatar' => $avatar,
            'position' => $this->pivot->position,
            'rating' => TaskRating::getRating($groupMemberTaskStatistic),
            'portfolio' => $groupMemberTaskStatistic->getStatistic()
        ];
    }

}
