<?php

namespace App\Http\Requests\Control\Tasks;

use App\Http\Requests\ApiRequest;

class UpdateTaskStatusRequest extends ApiRequest
{

    public function rules()
    {
        return [
            'id' => 'required|integer|exists:tasks,id',
            'task_status_id' => 'integer|exists:task_statuses,id'
        ];
    }
}
