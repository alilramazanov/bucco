<?php

namespace App\Http\Resources\Control\Member;

use App\Http\Resources\Control\PositionTemplate\PositionTemplateResource;
use App\Models\PositionTemplate;
use App\Resources\Control\Portfolio\GroupMemberPortfolio;
use App\Resources\Control\Rating\MemberRating;
use App\Resources\Control\Statistic\Statistic;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupMemberListResource extends JsonResource
{

    public function toArray($request)
    {
        $groupMemberPortfolio = (new GroupMemberPortfolio())->getGroupMemberPortfolio($this->id, $this->pivot->group_id);
        $groupMemberRating =  (new MemberRating())->getGroupMemberRating($groupMemberPortfolio);
        $groupMemberPosition = new PositionTemplateResource(PositionTemplate::find($this->pivot->position_template_id));

        return [
            'id' => $this->id,
            'groupId' => $this->pivot->group_id,
            'name' => $this->name,
            'position' => $groupMemberPosition,
            'rating' => $groupMemberRating,
            'portfolio' => $groupMemberPortfolio

        ];
    }

}
