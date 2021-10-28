<?php

namespace App\Http\Requests\Control\Members;

use App\Http\Requests\ApiRequest;

class AdminMemberListRequest extends ApiRequest
{

    public function rules()
    {
        return [
            'admin_id' => 'integer|exists:admins,id'
        ];
    }
}
