<?php

namespace App\Http\Resources\Control\Task;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupTasksResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->TaskTemplate->name,
            'description' => $this->description,
            'startAt' => $this->start_at,
            'endAt' => $this->end_at

        ];
    }

}
