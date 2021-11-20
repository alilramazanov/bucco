<?php

namespace App\Http\Requests\Control\Members;

use App\Http\Requests\ApiRequest;

class UpdateMemberRequest extends ApiRequest
{

    public function rules()
    {
        return [
            'id' => 'required|integer|exists:members,id',
            'name' => 'string|max:50|min:2',
            'login' => 'string|max:50|min:3',
            'avatar' => 'file|mimes:jpg,jpeg,png,svg',
            'serial' => 'numeric|digits_between:4,4',
            'number' => 'numeric|digits_between:6,6',
            'address' => 'string|min:3',
        ];
    }
}
