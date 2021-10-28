<?php

namespace App\Http\Requests\Control\Tasks;

use App\Http\Requests\ApiRequest;

class DeleteTaskRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'id' => 'integer|exists:tasks,id'

        ];
    }

}
