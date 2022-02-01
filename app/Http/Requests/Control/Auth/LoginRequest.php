<?php

namespace App\Http\Requests\Control\Auth;

use App\Http\Requests\ApiRequest;

class LoginRequest extends ApiRequest
{

    public function rules()
    {
        return [
            'login' => 'required|string|max:50',
            'password' => 'required|string|max:255',
            'onesignal_app' => 'required|string'
        ];
    }
}
