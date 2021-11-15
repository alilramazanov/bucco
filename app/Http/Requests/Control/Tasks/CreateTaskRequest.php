<?php

namespace App\Http\Requests\Control\Tasks;

use App\Http\Requests\ApiRequest;

class CreateTaskRequest extends ApiRequest
{


    public function rules()
    {
        return [
            'name' => 'string|min:2|max:50|required',
            'description' => 'string',
            'group_id' => 'required|integer|exists:groups,id',
            'member_id' => 'required|integer|exists:members,id',
            'start_at' => 'required|date',
            'end_at' => 'required|date'
        ];
    }
}
