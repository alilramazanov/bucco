<?php

namespace App\Http\Requests\Control\Groups;

use App\Http\Requests\ApiRequest;

class CreateGroupRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'name' => 'string|max:50|min:3',
            'admin_id' => 'integer|exists:admins,id',
            'avatar' => 'file|mimes:jpg,jpeg,png,svg'
        ];
    }

}
