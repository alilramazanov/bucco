<?php

namespace App\Http\Requests\Control\Groups;

use App\Http\Requests\ApiRequest;

class UpdateGroupRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'id' => 'required|integer|exists:groups,id',
            'name' => 'string|min:3|max:50',
            'avatar' => 'file|mimes:jpg,jpeg,png,svg'
        ];
    }

}
