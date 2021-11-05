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
        $query = http_build_query(
            array(
                'path' => $this->avatar,
            )
        );

        $avatar = $this->avatar ? \Illuminate\Support\Facades\URL::to('image' . '?' . $query) : null;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'login' => $this->login,
            'avatar' => $avatar,
        ];
    }
}
