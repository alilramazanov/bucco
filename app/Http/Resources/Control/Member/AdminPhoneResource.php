<?php

namespace App\Http\Resources\Control\Member;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminPhoneResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'adminPhone' => $this->phone_number

        ];
    }

}
