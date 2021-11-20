<?php

namespace App\Http\Requests\Control\Members;

use App\Http\Requests\ApiRequest;

class DetailGroupMemberRequest extends ApiRequest
{

    public function rules()
    {
        return [
            'id' => 'integer|required|exists:group_members,id'
        ];
    }
}
