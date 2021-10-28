<?php

namespace App\Http\Requests\Control\Groups;

use App\Http\Requests\ApiRequest;

class UpdateGroupRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'id' => 'integer|exists:groups,id'

        ];
    }

}
