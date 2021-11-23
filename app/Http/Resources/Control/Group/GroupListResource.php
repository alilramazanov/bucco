<?php

namespace App\Http\Resources\Control\Group;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupListResource extends JsonResource
{
    public function toArray($request): array
    {
        $query = http_build_query(
            array(
                'path' => $this->avatar,
            )
        );

        $avatar = $this->avatar ? \Illuminate\Support\Facades\URL::to('image' . '?' . $query) : null;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'adminId' => $this->admin_id,
            'avatar' => $avatar

        ];
    }


}
