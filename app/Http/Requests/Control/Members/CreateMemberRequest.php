<?php

namespace App\Http\Requests\Control\Members;

use App\Http\Requests\ApiRequest;

class CreateMemberRequest extends ApiRequest
{

    public function rules()
    {
        return [
            'name' => 'string|max:50',
            'login' => 'string|max:50',
            'password' => 'required|string|max:255|min:6|confirmed',
            'password_confirmation' => 'required|string|max:255|min:6',
            'admin_id' => 'integer|exists:admins,id',
            'group_id' => 'integer|exists:groups,id',
            'position' => 'string|max:50',
        ];
    }


}
