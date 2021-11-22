<?php

namespace App\Http\Resources\Control\Auth;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

/**
 * @mixin \StdClass
 */
 class LoginResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'token' => $this->token,
            'tokenType' => 'bearer',
            'expiresIn' => Auth::factory()->getTTL() * config('auth.expires_in')
        ];
    }

}
