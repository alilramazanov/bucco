<?php

namespace App\Http\Requests\Control\Tasks;

use App\Http\Requests\ApiRequest;

class DetailTaskRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'id' => 'required|integer|exists:tasks,id'
        ];
    }

}
