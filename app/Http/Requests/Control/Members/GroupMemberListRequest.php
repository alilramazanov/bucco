<?php

namespace App\Http\Requests\Control\Members;

use App\Http\Requests\ApiRequest;

class GroupMemberListRequest extends ApiRequest
{

    public function rules()
    {
        return [
            'group_id' => 'integer|required|exists:groups,id'

        ];
    }
}
