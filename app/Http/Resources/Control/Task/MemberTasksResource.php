<?php

namespace App\Http\Resources\Control\Task;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberTasksResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'statusName' => $this->taskStatus->name,
            'description' => $this->description,
            'startAt' => Carbon::parse($this->start_at)->format('d-m-Y H:i:s'),
            'endAt' => Carbon::parse($this->end_at)->format('d-m-Y H:i:s')

        ];
    }

}
