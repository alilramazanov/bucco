<?php

namespace App\Http\Resources\Control\Group;

use App\Resources\Control\Portfolio\Group\GroupPercentageTaskStatistic;
use Illuminate\Http\Resources\Json\JsonResource;

class GroupStatisticListResource extends JsonResource
{

    public function toArray($request): array
    {

        $groupPercentageTaskStatistic = new GroupPercentageTaskStatistic();
        $groupPercentageTaskStatistic->setFields(['group_id' => $this->id]);
        $groupPercentageTaskStatistic->makeStatistic();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'adminId' => $this->admin_id,
            'statistic' => $groupPercentageTaskStatistic->getStatistic()

        ];
    }
}
