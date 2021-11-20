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
            'avatar' => 'file|mimes:jpg,jpeg,png,svg',
            'serial' => 'numeric|digits_between:4,4',
            'number' => 'numeric|digits_between:6,6',
            'address' => 'string|min:3',
        ];
    }
}
