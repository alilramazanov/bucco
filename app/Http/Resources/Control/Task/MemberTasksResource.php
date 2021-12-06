<?php

namespace App\Http\Resources\Control\Task;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Task
 */
class MemberTasksResource extends JsonResource
{

    public function toArray($request)
    {
        return [
//            'date' => [
//                'date' => Carbon::parse($this->start_at)->format('d-m-Y H:i:s'),
            'id' => $this->id,
            'name' => $this->name,
            'status' => [
                'statusId' => $this->task_status_id,
                'statusName' => $this->taskStatus->name,
            ],
            'description' => $this->description,
            'startAt' => Carbon::parse($this->start_at)->format('d-m-Y H:i:s'),
            'endAt' => Carbon::parse($this->end_at)->format('d-m-Y H:i:s')
//            ]
        ];
    }

}
