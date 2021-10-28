<?php

namespace App\Http\Requests\Control\Tasks;

use App\Http\Requests\ApiRequest;

class UpdateTaskRequest extends ApiRequest
{


    public function rules()
    {
        return [
            'id' => 'integer|exists:tasks,id',
            'task_status_id' => 'integer|exists:task_statuses,id'
        ];
    }

}
