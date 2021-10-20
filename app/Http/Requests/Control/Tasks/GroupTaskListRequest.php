<?php

namespace App\Http\Requests\Control\Tasks;

use App\Http\Requests\ApiRequest;

class GroupTaskListRequest extends ApiRequest
{

    public function rules()
    {
        return [
            'group_id' => 'integer|exists:groups,id|required'
        ];
    }
}
