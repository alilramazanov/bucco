<?php

namespace App\Http\Resources\Control\Group;

use App\Resources\Control\Statistic\Statistic;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupStatisticListResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'adminId' => $this->admin_id,
            'statistic' => (new Statistic())->getGroupStatistic($this->id)

        ];
    }
}
