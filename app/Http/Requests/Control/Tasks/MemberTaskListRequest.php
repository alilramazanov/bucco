<?php

namespace App\Http\Requests\Control\Tasks;

use App\Http\Requests\ApiRequest;

class MemberTaskListRequest extends ApiRequest
{

    public function rules()
    {
        return [
            'task_status_id' => 'required|integer|exists:task_statuses,id'
        ];
    }
}
