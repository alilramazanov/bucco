<?php

namespace App\Http\Requests\Control\Groups;

use App\Http\Requests\ApiRequest;

class CreateGroupRequest extends ApiRequest
{
    public function rules()
    {
        return [
            [
                'admin_id' => 'integer|exists:admins,id'
            ]
        ];
    }

}
