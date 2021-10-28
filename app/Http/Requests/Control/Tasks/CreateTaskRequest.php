<?php

namespace App\Http\Requests\Control\Tasks;

use App\Http\Requests\ApiRequest;

class CreateTaskRequest extends ApiRequest
{


    public function rules()
    {
        return [
            'admin_id' => 'integer|exists:admins,id',
            'group_id' => 'integer|exists:groups,id',
            'member_id' => 'integer|exists:members,id',
            'task_template_id' => 'integer'


        ];
    }
}
