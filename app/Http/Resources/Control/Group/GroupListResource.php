<?php

namespace App\Http\Resources\Control\Group;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupListResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'adminId' => $this->admin_id

        ];
    }


}
