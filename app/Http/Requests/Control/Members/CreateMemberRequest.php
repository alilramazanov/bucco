<?php

namespace App\Http\Requests\Control\Members;

use App\Http\Requests\ApiRequest;

class CreateMemberRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'name' => 'string|max:50|min:3|required',
            'login' => 'string|max:50|min:3|required',
            'password' => 'required|string|max:255|min:6|confirmed',
            'password_confirmation' => 'required|string|max:255|min:6',
        ];
    }
}
