<?php

namespace App\Http\Resources\Control\PositionTemplate;

use Illuminate\Http\Resources\Json\JsonResource;

class PositionTemplateResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name

        ];
    }

}
