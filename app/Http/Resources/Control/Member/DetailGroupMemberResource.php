<?php

namespace App\Http\Resources\Control\Member;

use Illuminate\Http\Resources\Json\JsonResource;

class DetailGroupMemberResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'position' => $this->position,
            'startWorkingDay' => $this->start_working_day,
            'endWorkingDay' => $this->end_working_day,
            'memberId' => $this->member_id
        ];
    }
}
