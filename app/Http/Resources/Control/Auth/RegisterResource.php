<?php

namespace App\Http\Resources\Control\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 *
 * @mixin \App\Models\Admin
 */
class RegisterResource extends JsonResource
{

    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'login' => $this->login,
        ];
    }
}
