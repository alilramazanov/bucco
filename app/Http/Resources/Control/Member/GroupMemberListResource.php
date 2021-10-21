<?php

namespace App\Http\Resources\Control\Member;

use App\Http\Resources\Control\PositionTemplate\PositionTemplateResource;
use App\Models\PositionTemplate;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupMemberListResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'groupId' => $this->pivot->group_id,
            'name' => $this->name,
            'position' => new PositionTemplateResource(PositionTemplate::find($this->pivot->position_template_id)),
            'rating' => 'Класс рейтинга рейтинга в разработке',
            'portfolio'

        ];
    }

}
