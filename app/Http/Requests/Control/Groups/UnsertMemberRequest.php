<?php

namespace App\Http\Requests\Control\Groups;

use App\Http\Requests\ApiRequest;

class UnsertMemberRequest extends ApiRequest
{

    public function rules()
    {
        return [
            'member_id' => 'integer|exists:members,id',
            'group_id' =>'integer|exists:groups,id'

        ];
    }
}
