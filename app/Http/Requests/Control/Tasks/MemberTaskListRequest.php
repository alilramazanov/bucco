<?php

namespace App\Http\Requests\Control\Tasks;

use App\Http\Requests\ApiRequest;

class MemberTaskListRequest extends ApiRequest
{

    public function rules()
    {
        return [
            'group_id' => 'required|integer|exists:groups,id',
            'member_id' => 'required|integer|exists:members,id',
            'status_id' => 'required|integer|exists:task_statuses,id'
        ];
    }
}
