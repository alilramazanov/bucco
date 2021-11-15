<?php

namespace App\Http\Requests\Control\Auth;

use App\Http\Requests\ApiRequest;

class UpdateProfileRequest extends ApiRequest
{

    public function rules()
    {
        return [
            'login' => 'required|string|max:50|min:3',
            'avatar' => 'file|mimes:jpg,jpeg,png'
        ];
    }
}
