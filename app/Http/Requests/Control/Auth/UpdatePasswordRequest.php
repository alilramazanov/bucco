<?php

namespace App\Http\Requests\Control\Auth;

use App\Http\Requests\ApiRequest;

class UpdatePasswordRequest extends ApiRequest
{

    public function rules()
    {
        return [
            'password' => 'required|string|max:255|min:6',
            'newPassword' => 'required|string|max:255|min:6'
        ];
    }
}
