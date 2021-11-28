<?php

namespace App\Http\Resources\Control\Portfolio;

use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'all' => $this->task_all,
            'completed' => $this->task_completed,
            'overdue' => $this->task_overdue
        ];
    }

}
