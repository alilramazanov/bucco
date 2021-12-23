<?php

namespace App\Http\Resources\Control\Member;

use App\Models\GroupMember;
use App\Models\Member;
use App\Resources\Control\Penalties\PenaltiesMember;
use App\Resources\Control\Portfolio\Member\GroupMemberTasksStatistic;
use App\Resources\Control\Portfolio\Member\MemberPortfolio;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin GroupMember
 */
class DetailGroupMemberResource extends JsonResource
{

    public function toArray($request)
    {

        $groupMemberTaskStatistic = new GroupMemberTasksStatistic();
        $groupMemberTaskStatistic->setFields(['member_id' => $this->id, 'group_id' => $this->group_id]);
        $groupMemberTaskStatistic->makeStatistic();

//        $groupMemberPortfolio = (new MemberPortfolio())->getGroupMemberPortfolio($this->id, $this->group_id);
        $penalties = (new PenaltiesMember())->allGroupMemberPenalties($this->group_id, $this->member_id);

        return [
            'id' => $this->id,
            'position' => $this->position,
            'startWorkingDay' => $this->start_working_day,
            'endWorkingDay' => $this->end_working_day,
            'member' => new DetailMemberResource(Member::find($this->member_id)),
            'portfolio' => $groupMemberTaskStatistic->getStatistic(),
            'penalties' => $penalties
        ];
    }
}
