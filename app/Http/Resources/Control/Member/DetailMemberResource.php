<?php

namespace App\Http\Resources\Control\Member;

use App\Models\Member;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Member
 */
class DetailMemberResource extends JsonResource
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
            'password' => $this->password_visible,
            'serial' => $this->serial,
            'number' => $this->number,
            'address' => $this->address,
        ];
    }
}
