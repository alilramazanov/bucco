<?php

namespace App\Http\Resources\Control\Group;

use Illuminate\Http\Resources\Json\JsonResource;

class DetailGroupResource extends JsonResource
{
    public function toArray($request)
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
            'admin' => $this->admin->name,
            'avatar' => $avatar
        ];
    }
}
