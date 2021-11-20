<?php

namespace App\Http\Requests\Control\Members;

use App\Http\Requests\ApiRequest;

class UpdateGroupMemberRequest extends ApiRequest
{

    public function rules()
    {
        return [
            'id' => 'integer|required|exists:group_members,id',
            'position' => 'string|max:50',
            'start_working_day' => 'date_format:H:i',
            'end_working_day' => 'date_format:H:i'
        ];
    }
}
