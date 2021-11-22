<?php

namespace App\Http\Requests\Control\Members;

use App\Http\Requests\ApiRequest;

class MemberTasksRequest extends ApiRequest
{

    public function rules()
    {
        return [
            'group_id' => 'required|integer|exists:groups,id',
            'status_id' => 'required|integer|exists:task_statuses,id'
        ];
    }
}
