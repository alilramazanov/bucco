<?php

namespace App\Http\Resources\Control\Task;

use Illuminate\Http\Resources\Json\JsonResource;

class AllGroupTasksResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->TaskTemplate->name,
            'description' => $this->description,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at

        ];
    }

}
