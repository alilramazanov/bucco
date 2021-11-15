<?php

namespace App\Http\Requests\Control\Tasks;

use App\Http\Requests\ApiRequest;

class UpdateTaskRequest extends ApiRequest
{


    public function rules()
    {
        return [
            'id' => 'required|integer|exists:tasks,id',
            'name' => 'string|min:2|max:50',
            'description' => 'string',
            'task_status_id' => 'integer|exists:task_statuses,id',
            'start_at' => 'date',
            'end_at' => 'date'
        ];
    }

}
