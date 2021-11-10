<?php

namespace App\Http\Resources\Control\Member;

use App\Http\Resources\Control\PositionTemplate\PositionTemplateResource;
use App\Models\PositionTemplate;
use App\Resources\Control\Portfolio\MemberPortfolio;
use App\Resources\Control\Rating\MemberRating;
use App\Resources\Control\Statistic\Statistic;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupMemberListResource extends JsonResource
{

    public function toArray($request)
    {

        $groupMemberPortfolio = (new MemberPortfolio())->getGroupMemberPortfolio($this->id, $this->pivot->group_id);
        $groupMemberRating =  (new MemberRating())->getMemberRating($groupMemberPortfolio);


        return [
            'id' => $this->id,
            'groupId' => $this->pivot->group_id,
            'name' => $this->name,
            'position' => $this->pivot->position,
            'rating' => $groupMemberRating,
            'portfolio' => $groupMemberPortfolio

        ];
    }

}