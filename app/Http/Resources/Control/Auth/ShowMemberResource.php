<?php

namespace App\Http\Resources\Control\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 *
 * @mixin \App\Models\Member
 */
class ShowMemberResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'login' => $this->login,
        ];
    }
}
