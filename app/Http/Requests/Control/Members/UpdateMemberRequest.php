<?php

namespace App\Http\Requests\Control\Members;

use App\Http\Requests\ApiRequest;

class UpdateMemberRequest extends ApiRequest
{

    public function rules()
    {
        return [
            'id' => 'integer|exists:members,id',
            'name' => 'string|max:50|min:2',
            'login' => 'string|max:50|min:3',
            'avatar' => 'file|mimes:jpg,jpeg,png'
        ];
    }
}
