<?php

namespace App\Http\Requests\Control\Groups;

use App\Http\Requests\ApiRequest;

class DetailGroupRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'id' => 'required|integer|exists:groups,id'
        ];
    }
}
