<?php

namespace App\Http\Requests\Control\Tasks;

use App\Http\Requests\ApiRequest;

class MemberTaskListRequest extends ApiRequest
{

    public function rules()
    {
        return [
            'group_id' => 'integer|exists:groups,id',
            'member_id' => 'integer|exists:members,id',
            'status_id' => 'integer|exists:task_statuses,id'
        ];
    }
}
