<?php

namespace App\Http\Requests\Control\Auth;

use App\Http\Requests\ApiRequest;

class RegisterRequest extends ApiRequest
{
    public function rules(): array
    {
        return [
            'name' => 'string|min:2|max:50',
            'login' => 'required|string|max:50|unique:admins',
            'password' => 'required|string|max:255|min:6|confirmed',
            'password_confirmation' => 'required|string|max:255|min:6',
            'admin_notification_id' => 'required|string'
        ];
    }


}
